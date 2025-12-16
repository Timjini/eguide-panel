<?php

namespace App\Listeners;

use App\Domain\Billing\Events\CompanySubscribed;

class SendSubscriptionConfirmationEmail
{
    /**
     * Create the event listener.
     */
    public function __construct() {}

    /**
     * Notify.
     */
    public function handle(CompanySubscribed $event): void
    {
        info('subscription email sent ------ ' . $event->billableId->value);
    }
}
