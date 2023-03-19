<?php

declare(strict_types=1);

namespace ItfTask\Emitter\Adapter;

use DomainException;
use ItfTask\Emitter\Infrastructure\RequestGenerator\LeadInterface;
use ItfTask\Emitter\Infrastructure\RequestGenerator\RequestGeneratorInterface;
use ItfTask\Emitter\Service\SenderInterface;

class Emitter
{
	private RequestGeneratorInterface $requestGenerator;
	private SenderInterface $sender;

	public function __construct(
		RequestGeneratorInterface $requestGenerator,
		SenderInterface $sender
	)
	{
		$this->requestGenerator = $requestGenerator;
		$this->sender = $sender;
	}

	public function __invoke($count = 0)
	{
		$leadCount = (int)$count;

		if (!$leadCount) {
			throw new DomainException("The 'count' parameter is invalid. Count must be an integer type and greater than 0.");
		}

		echo "Starting the send process...\n";

		$this->requestGenerator->generateLeads($leadCount, function (LeadInterface $lead) {
			echo "Send LeadId: " . $lead->getId() . ";\n";
			$this->sender->send($lead);
		});

		echo "Finish the send process.\n";
	}
}