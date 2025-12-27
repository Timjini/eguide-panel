<?php 

namespace App\Domain\Company;

use App\Domain\Company\ValueObjects\CompanyId;
use App\Domain\Company\ValueObjects\UserId;

final class User {
    private function __construct(
        private UserId $id,
        private string $name,
        private string $email,
        private CompanyId $companyId,
    ) {}

    public static function create(
        UserId $id,
        string $name,
        string $email,
        CompanyId $companyId,
    ): self {
        return new self($id, $name, $email, $companyId);
    }

    public function id(): UserId
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function companyId(): CompanyId
    {
        return $this->companyId;
    }
}
