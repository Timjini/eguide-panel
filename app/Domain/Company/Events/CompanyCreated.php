<?php

namespace App\Domain\Company\Events;

use App\Domain\Company\ValueObjects\CompanyId;

final class CompanyCreated
{
    public function __construct(
        public CompanyId $companyId,
    ) {}
}
