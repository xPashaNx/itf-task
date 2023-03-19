<?php

declare(strict_types=1);

namespace ItfTask\Emitter\Infrastructure\RequestGenerator;

interface RequestGeneratorInterface
{
	public function generateLeads(int $count, callable $leadHandler): void;
}