<?php

declare(strict_types=1);

namespace ItfTask\Emitter\Infrastructure\RequestPublisher;

use DomainException;
use ItfTask\Emitter\Infrastructure\RabbitMq\Connection;
use ItfTask\Emitter\Infrastructure\RabbitMq\Message;
use Throwable;

class RabbitMqPublisher implements RequestPublisherInterface
{
	private Connection $rabbitConnection;
	private string $exchange;
	private string $exchangeType;
	private string $queue;

	public function __construct(
		Connection $rabbitConnection,
		string $exchange,
		string $exchangeType,
		string $queue
	) {
		$this->rabbitConnection = $rabbitConnection;
		$this->exchange = $exchange;
		$this->exchangeType = $exchangeType;
		$this->queue = $queue;
	}

	/**
	 * @param array $data
	 * @return void
	 * @throws Throwable
	 */
	public function execute($data)
	{
		if (!is_array($data)) {
			throw new DomainException("The data must be an array type.");
		}

		try {
			$connection = $this->rabbitConnection->getConnection();
			$channel = $connection->channel();
			$channel->queue_declare($this->queue, false, true, false, false);
			$channel->exchange_declare($this->exchange, $this->exchangeType, false, true, false);
			$channel->queue_bind($this->queue, $this->exchange);

			$message = Message::createFromArray($data);
			$channel->basic_publish($message, $this->exchange);

			$channel->close();
			$connection->close();
		} catch (Throwable $e) {
			// ... Write to Logger
			throw new $e;
		}

	}
}