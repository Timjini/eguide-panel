<?php

use App\Jobs\SubscribeCompanyToPlan;
use App\Domain\Billing\BillingService;
use App\Domain\Billing\ValueObjects\BillableId;
use App\Domain\Billing\ValueObjects\PlanCode;
use Ramsey\Uuid\Uuid;

it('subscribes company to a plan via billing service', function () {
    $billableId = Uuid::uuid4()->toString();

    $this->mock(BillingService::class)
        ->shouldReceive('subscribeCompany')
        ->once()
        ->with(
            \Mockery::type(BillableId::class),
            \Mockery::type(PlanCode::class)
        );

    SubscribeCompanyToPlan::dispatchSync(
        billableId: $billableId,
        planCode: 'basic_monthly'
    );
});
