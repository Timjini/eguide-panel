<?php
use App\Domain\Billing\ValueObjects\PlanCode;

it('creates a valid plan code', function () {
    $code = new PlanCode('basic_monthly');

    expect($code->value())->toBe('basic_monthly');
});

it('rejects empty plan code', function () {
    new PlanCode('');
})->throws(DomainException::class);
