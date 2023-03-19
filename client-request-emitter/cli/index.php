<?php

declare(strict_types=1);

use ItfTask\Emitter\Adapter\Emitter;
use Psr\Container\ContainerInterface;
use Symfony\Component\Dotenv\Dotenv;

require_once dirname(__DIR__) . '/vendor/autoload.php';

array_shift($argv);

$dotenv = new Dotenv(true);
$dotenv->load(__DIR__ . '/../.env');

/** @var ContainerInterface $container */
$container = require __DIR__ . '/../config/container.php';

/** @var Emitter $app */
$app = (require __DIR__ . '/../config/app.php')($container);
$app(...$argv);