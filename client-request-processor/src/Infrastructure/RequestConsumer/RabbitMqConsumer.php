<?php

declare(strict_types=1);

namespace ItfTask\Processor\Infrastructure\RequestConsumer;

use ItfTask\Processor\Infrastructure\RabbitMq\Connection;
use PhpAmqpLib\Message\AMQPMessage;
use Throwable;

class RabbitMqConsumer implements RequestConsumerInterface
{
	private Connection $rabbitConnection;
	private string $exchange;
	private string $exchangeType;
	private string $queue;

	private ProcessHandlerInterface $handler;

	public function __construct(
		Connection $rabbitConnection,
		string $exchange,
		string $exchangeType,
		string $queue
	)
	{
		$this->rabbitConnection = $rabbitConnection;
		$this->exchange = $exchange;
		$this->exchangeType = $exchangeType;
		$this->queue = $queue;
	}

	public function listenProcess(ProcessHandlerInterface $handler)
	{
		$this->handler = $handler;

		try {
			$connection = $this->rabbitConnection->getConnection();
			$channel = $connection->channel();

			echo "RabbitMq connected. \n";

			$channel->queue_declare($this->queue, false, true, false, false);
			$channel->exchange_declare($this->exchange, $this->exchangeType, false, true, false);
			$channel->queue_bind($this->queue, $this->exchange);

			$channel->basic_qos(null, 1, null);
			$channel->basic_consume($this->queue, 'consumer', false, false, false, false, [$this, 'callback']);

			register_shutdown_function([$this, 'shutdown'], $channel, $connection);

			while (count($channel->callbacks)) {
				$channel->wait();
			}

			$channel->close();
			$connection->close();
		} catch (Throwable $e) {
			// ... Write to Logger
			throw new $e;
		}
	}

	final function callback(AMQPMessage $message): void
	{
		if ($message->body === 'quit') {
			$message->delivery_info['channel']->basic_cancel($message->delivery_info['consumer_tag']);
			return;
		}

		$result = $this->handler->handle($message->body);

		if (!$result) {
			$message->delivery_info['channel']->basic_nack($message->delivery_info['delivery_tag'], false, true);
		} else {
			$message->delivery_info['channel']->basic_ack($message->delivery_info['delivery_tag']);
		}
	}

	final function shutdown($channel, $connection): void
	{
		$channel->close();
		$connection->close();
	}
}