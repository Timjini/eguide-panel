<?php 

namespace App\Domain\Company\ValueObjects;

final class Address
{
    public function __construct(
        public string $address,
        public string $postCode,
        public string $city,
        public ?string $district,
        public string $country,
    ) {
        if ($address === '' || $postCode === '' || $city === '' || $country === '') {
            throw new \DomainException('Address is incomplete');
        }
    }
}