<?php

namespace App\Infrastructure\Persistence\Eloquent;

use App\Domain\Company\Company;

final class CompanyRepository
{
    public function save(Company $company): void
    {
        \App\Models\Company::create([
            'legal_name' => $company->legalName,
            'contact_person' => $company->contactPerson,
            'primary_email' => $company->primaryEmail,
            'website' => $company->website,
            'phone_1' => $company->phone1,

            'address' => $company->address->address,
            'post_code' => $company->address->postCode,
            'city' => $company->address->city,
            'district' => $company->address->district,
            'country' => $company->address->country,

            'vat_number' => $company->vatNumber->value(),

            // Cashier defaults
            'stripe_id' => null,
            'pm_type' => null,
            'pm_last_four' => null,
            'trial_ends_at' => null,
        ]);
    }
}
