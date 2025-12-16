<?php

use App\Domain\Billing\Subscription;
use App\Domain\Billing\Plan;
use App\Domain\Billing\ValueObjects\PlanCode;
use App\Domain\Billing\ValueObjects\Money;
use App\Domain\Billing\ValueObjects\Interval;

it('knows when subscription is active', function () {
    // $plan = new Plan(
    //     new PlanCode('basic'),
    //     new Money(1000),
    //     Interval::MONTHLY
    // );

    $subscription = new Subscription(
        new PlanCode('basic'),
        new DateTimeImmutable('-1 day')
    );

    expect($subscription->isActive())->toBeTrue();
});
