<?php 

use App\Domain\Company\ValueObjects\Address;

it('creates a valid address', function () {
    $address = new Address(
        address: 'Main street 1',
        postCode: '12345',
        city: 'Berlin',
        district: null,
        country: 'DE',
    );

    expect($address->city)->toBe('Berlin');
});
