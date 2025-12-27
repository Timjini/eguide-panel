<?php

use App\Jobs\CreateCompany;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;

uses(RefreshDatabase::class);

it('creates a company through the bus command', function () {
    Bus::fake();

    $modelUser = User::factory()->create();

    CreateCompany::dispatch(
        [
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

        ],
        (string) $modelUser->id,
        $modelUser->name,
        $modelUser->email,
    );


    Bus::assertDispatched(CreateCompany::class);
});

it('persists company to database', function () {

    $user = User::factory()->create();

    CreateCompany::dispatchSync(
        [
            'id' => '0b92b6f4-bdac-4ac0-8291-991a478b812f',
            'primary_email' => 'info@test.com',
            'legal_name' => 'Test Ltd',
            'address' => 'Main street 1',
            'post_code' => '12345',
            'city' => 'Berlin',
            'country' => 'DE',
        ],
        (string) $user->id,
        $user->name,
        $user->email,
    );

    $this->assertDatabaseHas('companies', [
        'legal_name' => 'Test Ltd',
        'city' => 'Berlin',
        'country' => 'DE',
    ]);
});

// it('accepts a valid request', function () {
//     $response = $this->postJson('/companies', [
//         'primary_email' => 'info@test.com',
//         'legal_name' => 'new name',
//         'address' => 'Main',
//         'post_code' => '12345',
//         'city' => 'Berlin',
//         'country' => 'DE',
//     ]);

//     $response->assertStatus(302);
// });

// it('fails when domain rules are violated', function () {
//     $user = User::factory()->create();

//     CreateCompany::dispatchSync([
//         'primary_email' => 'invalid-email',
//         'address' => 'Main',
//         'post_code' => '12345',
//         'city' => 'Berlin',
//         'country' => 'DE',
//     ], $user);
// })->throws(DomainException::class);

// it('fails when attributes missing', function () {
//     $response = $this->postJson('/companies', [
//         'address' => 'Main',
//         'post_code' => '12345',
//         'city' => 'Berlin',
//         'country' => 'DE',
//     ]);

//     $response->assertStatus(422);
// });
