<?php

namespace HG\SmsPushNotification\Channels;

class FcmChannel extends GcmChannel
{
    /**
     * {@inheritdoc}
     */
    protected function pushServiceName()
    {
        return 'fcm';
    }
}
