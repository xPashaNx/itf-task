<?php

declare(strict_types=1);

namespace ItfTask\Processor\Infrastructure\Repository;

interface RepositoryInterface
{
	public function save(array $data);
}