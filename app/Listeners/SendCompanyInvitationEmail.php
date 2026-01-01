<?php 

namespace App\Listeners;

use App\Events\CompanyInvitationCreated;

class SendCompanyInvitationEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CompanyInvitationCreated $event): void
    {
        info('Company invitation email sent for invitation ID: ' . $event->invitation);
    }
}