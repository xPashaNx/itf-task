<?php

declare(strict_types=1);

namespace ItfTask\Emitter\Infrastructure\RabbitMq;

use Exception;
use PhpAmqpLib\Connection\AMQPConnection;

class Connection
{
	private string $host;
	private int $port;
	private string $user;
	private string $password;
	private string $vhost;

	public function __construct(
		string $host,
		int $port,
		string $user,
		string $password,
		string $vhost = "/"
	)
	{
		$this->host = $host;
		$this->port = $port;
		$this->user = $user;
		$this->password = $password;
		$this->vhost = $vhost;
	}

	/**
	 * @throws Exception
	 */
	public function getConnection(): AMQPConnection
	{
		try {
			return new AMQPConnection($this->host,
				$this->port,
				$this->user,
				$this->password,
				$this->vhost
			);
		} catch (Exception $e) {
			// ... Write to Logger
			throw new $e;
		}
	}
}