<?php

namespace App\Domain\Company\ValueObjects;

final class CompanyId
{
    public function __construct(public string $value)
    {
        if ($value === '') {
            throw new \DomainException('CompanyId cannot be empty');
        }
    }

    public function value(): string
    {
        return $this->value;
    }
}
