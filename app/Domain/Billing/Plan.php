<?php

namespace App\Domain\Billing;

use App\Domain\Billing\ValueObjects\Interval;
use App\Domain\Billing\ValueObjects\Money;
use App\Domain\Billing\ValueObjects\PlanCode;

final class Plan
{
    public function __construct(
        public PlanCode $code,
        public Money $price,
        public Interval $interval,
    ) {}
}