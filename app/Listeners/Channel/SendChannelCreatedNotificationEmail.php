<?php

namespace App\Listeners\Channel;

use App\Events\ChannelCreated;

class SendChannelCreatedNotificationEmail {
    public function __construct(
    )
    {
    }

    public function handle(ChannelCreated $event)
    {
        info("channel code" . $event->channelCode);
    }
}