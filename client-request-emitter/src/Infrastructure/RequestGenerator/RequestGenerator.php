<?php

declare(strict_types=1);

namespace ItfTask\Emitter\Infrastructure\RequestGenerator;

use LeadGenerator\Generator;
use LeadGenerator\Lead as BaseLead;

class RequestGenerator implements RequestGeneratorInterface
{
	private Generator $generator;

	public function __construct(Generator $generator)
	{
		$this->generator = $generator;
	}

	public function generateLeads(int $count, callable $leadHandler): void
	{
		$this->generator->generateLeads(
			$count,
			fn(BaseLead $lead) => $leadHandler(new Lead($lead->id, $lead->categoryName))
		);
	}
}