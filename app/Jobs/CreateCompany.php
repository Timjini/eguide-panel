<?php

namespace App\Jobs;

use App\Domain\Company\CompanyFactory;
use App\Domain\Company\Events\CompanyCreated;
use App\Domain\Company\Repositories\CompanyRepositoryInterface as RepositoriesCompanyRepositoryInterface;
use App\Domain\Company\User;
use App\Domain\Company\ValueObjects\CompanyId;
use App\Domain\Company\ValueObjects\UserId;
use Illuminate\Foundation\Bus\Dispatchable;

final class CreateCompany
{
    use Dispatchable;

    public function __construct(
        public array $data,
        public string $userId,
        public string $userName,
        public string $userEmail,
    ) {}

    public function handle(
        CompanyFactory $factory,
        RepositoriesCompanyRepositoryInterface $repository,
    ): void {

        $companyId = CompanyId::generate();
        $this->data['id'] = $companyId->value();

        $company = $factory->create($this->data);
        $repository->save($company);
        
        $createdUser = User::create(
            id: UserId::fromString($this->userId),
            name: $this->userName,
            email: $this->userEmail,
            companyId: $companyId,
        );

        event(new CompanyCreated(
            $companyId,
            $createdUser->id(),
            $createdUser->name(),
            $createdUser->email(),
        ));
    }
}
