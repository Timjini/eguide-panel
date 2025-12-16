<?php 
use App\Domain\Company\CompanyFactory;
use App\Domain\Company\Company;

it('create a new company' , function() {
    $factory = new CompanyFactory();

    $company = $factory->create([
        'email' => 'info@test.com',
        'legal_name' => 'Test Ltd',
        'contact_person' => 'John Doe',
        'primary_email' => 'billing@test.com',
        'website' => 'https://test.com',
        'phone_1' => '123456',
        'address' => 'Main street 1',
        'post_code' => '12345',
        'city' => 'Berlin',
        'country' => 'DE',
    ]);

    expect($company)->toBeInstanceOf(Company::class)
    ->and($company->legalName)->toBe('Test Ltd')
    ->and($company->address->city)->toBe('Berlin');
});