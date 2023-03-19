<?php

declare(strict_types=1);

namespace ItfTask\Emitter\Infrastructure\RabbitMq;

use PhpAmqpLib\Message\AMQPMessage;

class Message
{
	public static function create(array $body, array $extraProperties = []): AMQPMessage
	{
		$properties = ['content_type' => 'text/plain', 'delivery_mode' => 2];
		return new AMQPMessage(json_encode($body), array_merge($properties, $extraProperties));
	}

	public static function createFromArray(array $body, array $extraProperties = []): AMQPMessage
	{
		return static::create($body, $extraProperties);
	}
}