<?php 

namespace App\Domain\Billing\ValueObjects;

final class PlanCode
{
    public function __construct(private string $value)
    {
        if ($value === '') {
            throw new \DomainException('Plan code cannot be empty');
        }
    }

    public function value(): string
    {
        return $this->value;
    }
}