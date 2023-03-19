<?php

declare(strict_types=1);

namespace ItfTask\Emitter\Infrastructure\RequestPublisher;

interface RequestPublisherInterface
{
	public function execute($data);
}