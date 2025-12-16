<?php

namespace App\Domain\Company;

use App\Domain\Company\ValueObjects\Address;
use App\Domain\Company\ValueObjects\PrimaryEmail;
use App\Domain\Company\ValueObjects\VatNumber;

final class CompanyFactory
{
    public function create(array $data): Company
    {
        return Company::create(
            legalName: $data['legal_name'] ?? null,
            contactPerson: $data['contact_person'] ?? null,
            primaryEmail: new PrimaryEmail($data['primary_email'] ?? null),
            website: $data['website'] ?? null,
            phone1: $data['phone_1'] ?? null,
            address: new Address(
                address: $data['address'],
                postCode: $data['post_code'],
                city: $data['city'],
                district: $data['district'] ?? null,
                country: $data['country'],
            ),
            vatNumber: new VatNumber($data['vat_number'] ?? null),
        );
    }
}
