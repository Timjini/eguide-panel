<?php

namespace App\Jobs;

use App\Domain\Company\CompanyFactory;
use App\Domain\Company\Events\CompanyCreated;
use App\Domain\Company\Repositories\CompanyRepositoryInterface as RepositoriesCompanyRepositoryInterface;
use App\Domain\Company\ValueObjects\CompanyId;
use Illuminate\Foundation\Bus\Dispatchable;

final class CreateCompany
{
    use Dispatchable;

    public function __construct(public array $data) {}

    public function handle(
        CompanyFactory $factory,
        RepositoriesCompanyRepositoryInterface $repository,
    ): void {

        // generate uuid and assign it to factory
        $companyId = CompanyId::generate();
        $this->data['id'] = CompanyId::generate();

        $company = $factory->create($this->data);

        // infrustructure
        $repository->save($company);

        event(new CompanyCreated($companyId));
    }
}
