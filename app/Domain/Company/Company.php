<?php

namespace App\Domain\Company;

use App\Domain\Company\ValueObjects\Address;
use App\Domain\Company\ValueObjects\PrimaryEmail;
use App\Domain\Company\ValueObjects\VatNumber;


final class Company
{
    private function __construct(
        public ?string $legalName,
        public ?string $contactPerson,
        public ?string $primaryEmail,
        public ?string $website,
        public ?string $phone1,
        public Address $address,
        public VatNumber $vatNumber,

        // Billing (Cashier)
        public ?string $stripeId = null,
        public ?string $pmType = null,
        public ?string $pmLastFour = null,
        public ?\DateTimeInterface $trialEndsAt = null,
    ) {}

    public static function create(
        ?string $legalName,
        ?string $contactPerson,
        ?PrimaryEmail $primaryEmail,
        ?string $website,
        ?string $phone1,
        Address $address,
        VatNumber $vatNumber,
    ): self {
        return new self(
            legalName: $legalName,
            contactPerson: $contactPerson,
            primaryEmail: $primaryEmail?->value(),
            website: $website,
            phone1: $phone1,
            address: $address,
            vatNumber: $vatNumber,
        );
    }
}
