<?php

declare(strict_types=1);

namespace ItfTask\Processor\Repository;

use DateTimeImmutable;
use ItfTask\Processor\Infrastructure\Repository\RepositoryInterface;
use ItfTask\Processor\ValueObject\Lead;

class RequestRepository
{
	private RepositoryInterface $repository;

	public function __construct(RepositoryInterface $repository)
	{
		$this->repository = $repository;
	}

	public function save(Lead $lead, DateTimeImmutable $createdAt): void
	{
		$data = $lead->toArray();
		$data['createdAt'] = $createdAt->format("d-m-Y H:i:s");

		$this->repository->save($data);
	}
}