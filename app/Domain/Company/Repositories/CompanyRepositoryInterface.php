<?php

namespace App\Domain\Company\Repositories;

use App\Domain\Company\Company;

interface CompanyRepositoryInterface
{
    /**
     * Persists a Company domain entity.
     */
    public function save(Company $company): void;
}
