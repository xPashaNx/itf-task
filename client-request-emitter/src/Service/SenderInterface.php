<?php

declare(strict_types=1);

namespace ItfTask\Emitter\Service;

use ItfTask\Emitter\Infrastructure\RequestGenerator\LeadInterface;

interface SenderInterface
{
	public function send(LeadInterface $lead);
}