<?php

namespace App\Domain\Billing;

use App\Domain\Billing\ValueObjects\BillableId;
use App\Domain\Billing\ValueObjects\PlanCode;


interface BillingService
{
    public function subscribeCompany(
        BillableId $billableId,
        PlanCode $planCode,
    ): void;
}
