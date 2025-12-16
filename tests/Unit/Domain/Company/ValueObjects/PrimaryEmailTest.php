<?php 

use App\Domain\Company\ValueObjects\PrimaryEmail;

it('creates an email address', function () {

    $email = new PrimaryEmail ('test@test.com');
    expect($email->value())->toBe('test@test.com');
});