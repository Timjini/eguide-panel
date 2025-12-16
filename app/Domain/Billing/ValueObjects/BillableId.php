<?php

namespace App\Domain\Billing\ValueObjects;

use DomainException;

final class BillableId
{
    public function __construct(
        public readonly string $value,
        public readonly string $type,
    ) {
        if ($value === '') {
            throw new \InvalidArgumentException('BillableId cannot be empty');
        }
    }
}
