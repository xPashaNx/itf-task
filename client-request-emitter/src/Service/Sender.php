<?php

declare(strict_types=1);

namespace ItfTask\Emitter\Service;

use ItfTask\Emitter\Infrastructure\RequestGenerator\LeadInterface;
use ItfTask\Emitter\Infrastructure\RequestPublisher\RequestPublisherInterface;

class Sender implements SenderInterface
{
	private RequestPublisherInterface $publisher;

	public function __construct(RequestPublisherInterface $publisher)
	{
		$this->publisher = $publisher;
	}

	public function send(LeadInterface $lead)
	{
		$this->publisher->execute($lead->toArray());
	}
}