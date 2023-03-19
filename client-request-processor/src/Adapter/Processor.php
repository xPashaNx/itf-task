<?php

declare(strict_types=1);

namespace ItfTask\Processor\Adapter;

use ItfTask\Processor\Infrastructure\RequestConsumer\ProcessHandlerInterface;
use ItfTask\Processor\Infrastructure\RequestConsumer\RequestConsumerInterface;

class Processor {
	private RequestConsumerInterface $requestConsumer;
	private ProcessHandlerInterface $processHandler;

	public function __construct(
		RequestConsumerInterface $requestConsumer,
		ProcessHandlerInterface $processHandler
	)
	{
		$this->requestConsumer = $requestConsumer;
		$this->processHandler = $processHandler;
	}

	public function __invoke(): void
	{
		echo "Start...\n";
		$this->requestConsumer->listenProcess($this->processHandler);
	}
}