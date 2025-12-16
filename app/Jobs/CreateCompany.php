<?php

namespace App\Jobs;

use App\Domain\Company\Events\CompanyCreated;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Str;
use Ramsey\Uuid\UuidInterface;

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

        $id = Str::uuid()->toString();

        $this->data['id'] = $id;

        $company = $factory->create($this->data);

        info('Company created =======>' . json_encode($company));

        $repository->save($company);

        // event(new CompanyCreated($id));
    }
}
