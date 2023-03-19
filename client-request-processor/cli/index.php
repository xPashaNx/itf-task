<?php
declare(strict_types=1);

use ItfTask\Processor\Adapter\Processor;
use Psr\Container\ContainerInterface;
use Symfony\Component\Dotenv\Dotenv;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$dotenv = new Dotenv(true);
$dotenv->load(__DIR__ . '/../.env');

/** @var ContainerInterface $container */
$container = require __DIR__ . '/../config/container.php';

/** @var Processor $app */
$app = (require __DIR__ . '/../config/app.php')($container);
$app();