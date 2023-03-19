<?php

declare(strict_types=1);

namespace ItfTask\Emitter\Infrastructure\RequestGenerator;

interface LeadInterface
{
	public function getId(): int;

	public function getCategoryName(): string;

	public function toArray(): array;
}