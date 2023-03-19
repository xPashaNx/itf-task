<?php

declare(strict_types=1);

use ItfTask\Processor\Infrastructure\RabbitMq\Connection;
use Psr\Container\ContainerInterface;

return [
	Connection::class => function (ContainerInterface $container): Connection {
		$config = $container->get('config')['rabbitMq'];
		return new Connection(
			$config['host'],
			(int)$config['port'],
			$config['user'],
			$config['password'],
			$config['vhost']
		);
	},

	'config' => [
		'rabbitMq' => [
			'host' => $_ENV['RABBIT_HOST'],
			'port' => $_ENV['RABBIT_PORT'],
			'user' => $_ENV['RABBIT_USER'],
			'password' => $_ENV['RABBIT_PASSWORD'],
			'vhost' => $_ENV['RABBIT_VHOST'],
		]
	],
];