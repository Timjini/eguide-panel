<?php

namespace App\Domain\Company\ValueObjects;

use Ramsey\Uuid\Uuid;

final class UserId
{
    private function __construct(private string $value)
    {
        if (!Uuid::isValid($value)) {
            throw new \DomainException('UserId invalid UUID');
        }
    }

    public static function generate(): self
    {
        return new self(Uuid::uuid4()->toString());
    }

    public static function fromString(string $value): self
    {
        return new self($value);
    }

    public function value(): string
    {
        return $this->value;
    }
}
