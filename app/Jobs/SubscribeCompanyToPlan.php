<?php

namespace App\Jobs;

use Illuminate\Foundation\Bus\Dispatchable;
use App\Domain\Billing\BillingService;
use App\Domain\Billing\Events\CompanySubscribed;
use App\Domain\Billing\ValueObjects\PlanCode;
use App\Domain\Billing\ValueObjects\BillableId;


final class SubscribeCompanyToPlan
{
    use Dispatchable;

    public function __construct(
        public string $billableId,
        public string $planCode,
    ) {}

    public function handle(BillingService $billing): void
    {
        //TODO type hard coded
        $billableId = new BillableId($this->billableId, 'company');
        $planCode = new PlanCode($this->planCode);

        $billing->subscribeCompany(
            billableId: $billableId,
            planCode: $planCode,
        );

        event(new CompanySubscribed($billableId, $planCode));
    }
}
