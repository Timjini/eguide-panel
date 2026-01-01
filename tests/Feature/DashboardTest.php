<?php

use App\Domain\Company\CompanyFactory;
use App\Models\User;

test('guests are redirected to the login page', function () {
    $response = $this->get(route('dashboard'));
    $response->assertRedirect(route('login'));
});

// test('authenticated users can visit the dashboard', function () {
//     $user = User::factory()->create();
//     $factory = new CompanyFactory();

//     $company = $factory->create([
//         'id' => '0b92b6f4-bdac-4ac0-8291-991a478b812f',
//         'email' => 'info@test.com',
//         'legal_name' => 'Test Ltd',
//         'contact_person' => 'John Doe',
//         'primary_email' => 'billing@test.com',
//         'website' => 'https://test.com',
//         'phone_1' => '123456',
//         'address' => 'Main street 1',
//         'post_code' => '12345',
//         'city' => 'Berlin',
//         'country' => 'DE',
//     ]);
//     $user->company_id = $company->id->value();
//     $user->save();
//     $this->actingAs($user);

//     $response = $this->get(route('dashboard'));
//     $response->assertStatus(200);
// });