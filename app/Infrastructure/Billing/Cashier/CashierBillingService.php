<?php

namespace App\Infrastructure\Billing\Cashier;

use App\Domain\Billing\BillingService;
use App\Domain\Billing\ValueObjects\BillableId;
use App\Domain\Billing\ValueObjects\PlanCode;

final class CashierBillingService implements BillingService
{
    public function subscribeCompany(
        BillableId $billableId,
        PlanCode $planCode,
    ): void {
        $company = \App\Models\Company::where('id', $billableId->value)->firstOrFail();

        $company->newSubscription('default', $planCode->value())
            ->create();
    }
}
