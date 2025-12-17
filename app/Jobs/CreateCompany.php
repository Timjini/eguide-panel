<?php

namespace App\Jobs;

use App\Domain\Company\CompanyFactory;
use App\Domain\Company\Events\CompanyCreated;
use App\Domain\Company\Repositories\CompanyRepositoryInterface as RepositoriesCompanyRepositoryInterface;
use App\Domain\Company\ValueObjects\CompanyId;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Str;

final class CreateCompany
{
    use Dispatchable;

    public function __construct(public array $data) {}

    public function handle(
        CompanyFactory $factory,
        RepositoriesCompanyRepositoryInterface $repository,
    ): void {

        info('Primary email value', [
            'exists' => array_key_exists('primary_email', $this->data),
            'value' => $this->data['primary_email'] ?? 'NULL',
        ]);

        // generate uuid and assign it to factory
        $companyId = new CompanyId(Str::uuid()->toString());
        $this->data['id'] = $companyId;

        info('Primary email value', [
            'data__' => array_key_exists('current_data', $this->data),
        ]);

        $company = $factory->create($this->data);


        // infrustructure
        $repository->save($company);

        event(new CompanyCreated($companyId));
    }
}
