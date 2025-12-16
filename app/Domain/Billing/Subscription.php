<?php

namespace App\Domain\Billing;

use App\Domain\Billing\ValueObjects\PlanCode;
use DateTimeImmutable;

final class Subscription
{
    public function __construct(
        public PlanCode $planCode,
        public \DateTimeImmutable $startedAt,
        public ?\DateTimeImmutable $endsAt = null,
    ) {}

    public function isActive(): bool
    {
        return $this->endsAt === null || $this->endsAt > new DateTimeImmutable();
    }
}