<?php

namespace App\Domain\Company\ValueObjects;

final class PrimaryEmail
{
    public function __construct(private ?string $value)
    {
        if ($value !== null && ! filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new \DomainException('Invalid primary email');
        }

    }

    public function value(): ?string
    {
        return $this->value;
    }
}