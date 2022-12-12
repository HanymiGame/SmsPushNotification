<?php

namespace HG\SmsPushNotification\Events;

use HG\SmsPushNotification\SmsPushNotification;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotificationPushed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var \HG\SmsPushNotification\SmsPushNotification
     */
    public $push;

    /**
     * Create a new event instance.
     *
     * @param  \HG\SmsPushNotification\SmsPushNotification $push
     */
    public function __construct(SmsPushNotification $push)
    {
        $this->push = $push;
    }
}
