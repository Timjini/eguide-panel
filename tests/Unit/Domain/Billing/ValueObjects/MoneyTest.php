<?php
use App\Domain\Billing\ValueObjects\Money;

it('creates valid money', function () {
    $money = new Money(1000, 'EUR');

    expect($money->amount)->toBe(1000)
        ->and($money->currency)->toBe('EUR');
});

it('rejects negative money', function () {
    new Money(-100);
})->throws(DomainException::class);
