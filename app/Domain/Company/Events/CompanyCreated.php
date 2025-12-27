<?php

namespace App\Domain\Company\Events;

use App\Domain\Company\ValueObjects\CompanyId;
use App\Domain\Company\ValueObjects\UserId;

final class CompanyCreated
{
    public function __construct(
        public CompanyId $companyId,
        public UserId $userId,
        public string $name,
        public string $email,
    ) {}
}
