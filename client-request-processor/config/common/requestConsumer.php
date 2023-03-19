<?php

declare(strict_types=1);

use ItfTask\Processor\Infrastructure\RabbitMq\Connection;
use ItfTask\Processor\Infrastructure\RequestConsumer\RabbitMqConsumer;
use ItfTask\Processor\Infrastructure\RequestConsumer\RequestConsumerInterface;
use Psr\Container\ContainerInterface;

return [
	RequestConsumerInterface::class => function (ContainerInterface $container): RequestConsumerInterface {
		$config = $container->get('config')['requestConsumer'];

		return new RabbitMqConsumer(
			$container->get(Connection::class),
			$config['exchange'],
			$config['exchangeType'],
			$config['queue']
		);
	},

	'config' => [
		'requestConsumer' => [
			'exchange' => 'router',
			'exchangeType' => 'direct',
			'queue' => 'msgs',
		]
	],
];