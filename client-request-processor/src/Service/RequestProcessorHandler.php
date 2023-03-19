<?php

declare(strict_types=1);

namespace ItfTask\Processor\Service;

use ItfTask\Processor\Infrastructure\RequestConsumer\ProcessHandlerInterface;
use Throwable;

class RequestProcessorHandler implements ProcessHandlerInterface
{
	public function handle(string $message): bool
	{
		try {
			sleep(3); //imitation of any work

			echo "THIS IS WORK!\n";
		} catch (Throwable $e) {
			// ... Write to Logger
			return false;
		}

		return true;
	}
}