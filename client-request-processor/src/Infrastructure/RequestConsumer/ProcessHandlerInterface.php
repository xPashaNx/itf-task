<?php

declare(strict_types=1);

namespace ItfTask\Processor\Infrastructure\RequestConsumer;

interface ProcessHandlerInterface
{
	public function handle(string $message): bool;
}