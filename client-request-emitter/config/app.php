<?php

declare(strict_types=1);

use ItfTask\Emitter\Adapter\Emitter;
use ItfTask\Emitter\Infrastructure\RequestGenerator\RequestGeneratorInterface;
use ItfTask\Emitter\Service\SenderInterface;
use Psr\Container\ContainerInterface;

return static function (ContainerInterface $container): Emitter {
	return new Emitter(
		$container->get(RequestGeneratorInterface::class),
		$container->get(SenderInterface::class)
	);
};