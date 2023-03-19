<?php

declare(strict_types=1);

namespace ItfTask\Processor\ValueObject;

use DomainException;

class Lead
{
	private int $id;
	private string $categoryName;

	public function __construct(int $id, string $categoryName)
	{
		$this->id = $id;
		$this->categoryName = $categoryName;
	}

	public static function createFromString(string $data): self
	{
		$leadData = json_decode($data, true);
		if (!isset($leadData['id'], $leadData['categoryName'])) {
			throw new DomainException("Lead data is invalid.");
		}

		return new static((int)$leadData['id'], $leadData['categoryName']);
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