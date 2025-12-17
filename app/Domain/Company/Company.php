<?php

namespace App\Domain\Company;

use App\Domain\Company\ValueObjects\Address;
use App\Domain\Company\ValueObjects\CompanyId;
use App\Domain\Company\ValueObjects\PrimaryEmail;
use App\Domain\Company\ValueObjects\VatNumber;


final class Company
{
    private function __construct(
        public CompanyId $id,
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
        CompanyId $id,
        ?string $legalName,
        ?string $contactPerson,
        ?PrimaryEmail $primaryEmail,
        ?string $website,
        ?string $phone1,
        Address $address,
        VatNumber $vatNumber,
    ): self {
        return new self(
            id: $id,
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
