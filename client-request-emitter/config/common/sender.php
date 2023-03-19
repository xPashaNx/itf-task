<?php

declare(strict_types=1);

use ItfTask\Emitter\Infrastructure\RequestPublisher\RequestPublisherInterface;
use ItfTask\Emitter\Service\Sender;
use ItfTask\Emitter\Service\SenderInterface;
use Psr\Container\ContainerInterface;

return [
	SenderInterface::class => function (ContainerInterface $container): SenderInterface {
		return new Sender(
			$container->get(RequestPublisherInterface::class)
		);
	},

	'config' => [
		'sender' => []
	],
];