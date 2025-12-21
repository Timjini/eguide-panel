<?php

use App\Jobs\CreateCompany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;

uses(RefreshDatabase::class);

it('creates a company through the bus command', function () {
    Bus::fake();

    CreateCompany::dispatch([
        'id' => '0b92b6f4-bdac-4ac0-8291-991a478b812f',
        'legal_name' => 'Test Ltd',
        'contact_person' => 'John Doe',
        'primary_email' => 'hatim.jini@gmail.com',
        'website' => 'https://test.com',
        'phone_1' => '123456',
        'address' => 'Main street 1',
        'post_code' => '12345',
        'city' => 'Berlin',
        'country' => 'DE',
    ]);


    Bus::assertDispatched(CreateCompany::class);
});

it('persists company to database', function () {
    CreateCompany::dispatchSync([
        'id' => '0b92b6f4-bdac-4ac0-8291-991a478b812f',
        'primary_email' => 'info@test.com',
        'legal_name' => 'Test Ltd',
        'address' => 'Main street 1',
        'post_code' => '12345',
        'city' => 'Berlin',
        'country' => 'DE',
    ]);

    $this->assertDatabaseHas('companies', [
        'legal_name' => 'Test Ltd',
        'city' => 'Berlin',
        'country' => 'DE',
    ]);
});

it('accepts a valid request', function () {
    $response = $this->postJson('/companies', [
        'primary_email' => 'info@test.com',
        'legal_name' => 'new name',
        'address' => 'Main',
        'post_code' => '12345',
        'city' => 'Berlin',
        'country' => 'DE',
    ]);

    $response->assertStatus(302);
});

it('fails when domain rules are violated', function () {
    CreateCompany::dispatchSync([
        'primary_email' => 'invalid-email',
        'address' => 'Main',
        'post_code' => '12345',
        'city' => 'Berlin',
        'country' => 'DE',
    ]);
})->throws(DomainException::class);

it('fails when attributes missing', function () {
    $response = $this->postJson('/companies', [
        'address' => 'Main',
        'post_code' => '12345',
        'city' => 'Berlin',
        'country' => 'DE',
    ]);

    $response->assertStatus(422);
});
