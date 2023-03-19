<?php

declare(strict_types=1);

use ItfTask\Emitter\Infrastructure\RequestGenerator\RequestGenerator;
use ItfTask\Emitter\Infrastructure\RequestGenerator\RequestGeneratorInterface;
use LeadGenerator\Generator;
use Psr\Container\ContainerInterface;

return [
	RequestGeneratorInterface::class => function (ContainerInterface $container): RequestGeneratorInterface {
		return new RequestGenerator(new Generator());
	},

	'config' => [
		'requestGenerator' => []
	],
];