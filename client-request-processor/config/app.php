<?php

declare(strict_types=1);

use ItfTask\Processor\Adapter\Processor;
use ItfTask\Processor\Infrastructure\RequestConsumer\RequestConsumerInterface;
use ItfTask\Processor\Service\RequestProcessorHandler;
use Psr\Container\ContainerInterface;

return static function (ContainerInterface $container): Processor {
	return new Processor(
		$container->get(RequestConsumerInterface::class),
		new RequestProcessorHandler()
	);
};