<?php

declare(strict_types=1);

namespace ItfTask\Processor\Service;

use DateTimeImmutable;
use ItfTask\Processor\Infrastructure\RequestConsumer\ProcessHandlerInterface;
use ItfTask\Processor\Repository\RequestRepository;
use ItfTask\Processor\ValueObject\Lead;
use Throwable;

class RequestProcessorHandler implements ProcessHandlerInterface
{
	private RequestRepository $repository;

	public function __construct(RequestRepository $repository)
	{
		$this->repository = $repository;
	}

	public function handle(string $message): bool
	{
		try {
			echo "Sleeping...\n";
			sleep(2); //imitation of any work

			$lead = Lead::createFromString($message);
			$this->repository->save($lead, new DateTimeImmutable());
		} catch (Throwable $e) {
			echo $e->getMessage() . "\n";
			// ... Write to Logger
			return false;
		}

		return true;
	}
}