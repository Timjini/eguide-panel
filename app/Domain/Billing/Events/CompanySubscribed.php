<?php

namespace App\Domain\Billing\Events;

use App\Domain\Billing\ValueObjects\BillableId;
use App\Domain\Billing\ValueObjects\PlanCode;

final class CompanySubscribed
{
    public function __construct(
        public BillableId $billableId,
        public PlanCode $planCode,
    ) {}
}
