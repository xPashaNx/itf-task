<?php

declare(strict_types=1);

namespace ItfTask\Emitter\Infrastructure\RequestGenerator;

class Lead implements LeadInterface
{
	private int $id;
	private string $categoryName;

	public function __construct(int $id, string $categoryName)
	{
		$this->id = $id;
		$this->categoryName = $categoryName;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getCategoryName(): string
	{
		return $this->categoryName;
	}

	public function toArray(): array
	{
		return [
			'id' => $this->getId(),
			'categoryName' => $this->getCategoryName(),
		];
	}
}