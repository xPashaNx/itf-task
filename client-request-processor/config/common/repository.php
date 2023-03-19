<?php

declare(strict_types=1);

use ItfTask\Processor\Infrastructure\Repository\FileStoreRepository;
use ItfTask\Processor\Infrastructure\Repository\RepositoryInterface;
use ItfTask\Processor\Repository\RequestRepository;
use Psr\Container\ContainerInterface;

return [
	RepositoryInterface::class => function (ContainerInterface $container): RepositoryInterface {
		$config = $container->get('config')['repository'];

		return new FileStoreRepository($config['filePath'], $config['filename']);
	},

	RequestRepository::class => function (ContainerInterface $container): RequestRepository {
		return new RequestRepository($container->get(RepositoryInterface::class));
	},

	'config' => [
		'repository' => [
			'filePath' => ROOT_PATH . 'var/',
			'filename' => sprintf("result-%s.txt", (new DateTimeImmutable())->format("d-m-Y"))
		]
	],
];