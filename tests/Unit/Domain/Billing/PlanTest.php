<?php

use App\Domain\Billing\Plan;
use App\Domain\Billing\ValueObjects\PlanCode;
use App\Domain\Billing\ValueObjects\Money;
use App\Domain\Billing\ValueObjects\Interval;

it('creates a plan', function () {
    $plan = new Plan(
        new PlanCode('pro_monthly'),
        new Money(2000),
        Interval::MONTHLY
    );

    expect($plan->code->value())->toBe('pro_monthly')
        ->and($plan->price->amount)->toBe(2000)
        ->and($plan->interval)->toBe(Interval::MONTHLY);
});
