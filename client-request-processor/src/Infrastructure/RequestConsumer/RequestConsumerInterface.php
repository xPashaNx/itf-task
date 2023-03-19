<?php

declare(strict_types=1);

namespace ItfTask\Processor\Infrastructure\RequestConsumer;

interface RequestConsumerInterface
{
	public function listenProcess(ProcessHandlerInterface $handler);
}