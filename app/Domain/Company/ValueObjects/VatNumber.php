<?php
namespace App\Domain\Company\ValueObjects;


final class VatNumber
{
    public function __construct(private ?string $value)
    {
        if ($value !== null && strlen($value) < 5) {
            throw new \DomainException('Invalid VAT number');
        }
    }

    public function value(): ?string
    {
        return $this->value;
    }
}
