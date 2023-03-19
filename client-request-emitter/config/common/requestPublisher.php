<?php

declare(strict_types=1);

use ItfTask\Emitter\Infrastructure\RabbitMq\Connection;
use ItfTask\Emitter\Infrastructure\RequestPublisher\RabbitMqPublisher;
use ItfTask\Emitter\Infrastructure\RequestPublisher\RequestPublisherInterface;
use Psr\Container\ContainerInterface;

return [
	RequestPublisherInterface::class => function (ContainerInterface $container): RequestPublisherInterface {
		$config = $container->get('config')['rabbitMqPublisher'];
		return new RabbitMqPublisher(
			$container->get(Connection::class),
			$config['exchange'],
			$config['exchangeType'],
			$config['queue']
		);
	},

	'config' => [
		'rabbitMqPublisher' => [
			'exchange' => 'router',
			'exchangeType' => 'direct',
			'queue' => 'msgs',
		]
	],
];