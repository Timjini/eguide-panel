<?php

namespace App\Jobs;

use Illuminate\Foundation\Bus\Dispatchable;

final class CreateCompany
{
    use Dispatchable;

    public function __construct(public array $data) {}

    public function handle(
        \App\Domain\Company\CompanyFactory $factory,
        \App\Infrastructure\Persistence\Eloquent\CompanyRepository $repository,
    ): void {
        info('Job started=======>');

        info('Primary email value', [
            'exists' => array_key_exists('primary_email', $this->data),
            'value' => $this->data['primary_email'] ?? 'NULL',
        ]);
        $company = $factory->create($this->data);

        $repository->save($company);
    }
}
