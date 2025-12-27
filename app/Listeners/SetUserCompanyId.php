<?php

namespace App\Listeners;

use App\Domain\Company\Events\CompanyCreated;
use App\Events\NewCompanyCreated;

class SetUserCompanyId
{
    public function __construct() {}

    public function handle(NewCompanyCreated $event): void
    {
        $user = $event->user;
        if ($user) {
            $user->company_id = $event->companyId;
            $user->save();  
        }
    }
}
