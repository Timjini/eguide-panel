<?php 

namespace App\Domain\Billing\ValueObjects;

enum Interval: string
{
    case MONTHLY = 'monthly';
    case YEARLY = 'yearly';
}