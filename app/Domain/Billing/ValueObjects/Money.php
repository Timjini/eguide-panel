<?php 

namespace App\Domain\Billing\ValueObjects;

final class Money
{
    public function __construct(
        public int $amount,
        public string $currency = 'EUR'
    ) {
        if ($amount < 0) {
            throw new \DomainException('Money must be positive');
        }
    }
}