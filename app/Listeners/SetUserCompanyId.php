<?php

namespace App\Listeners;

use App\Domain\Company\Events\CompanyCreated;

class SetUserCompanyId
{
    public function __construct() {}

    public function handle(CompanyCreated $event): void
    {
        info("set user company_id =======" . $event->companyId);
    }
}
