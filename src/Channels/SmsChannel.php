<?php

namespace HG\SmsPushNotification\Channels;

use HG\SmsPushNotification\Messages\SmsPushMessage;

class SmsChannel extends SmsPushChannel
{
    /**
     * {@inheritdoc}
     */
    protected function pushServiceName()
    {
        return 'sms';
    }

    /**
     * {@inheritdoc}
     */
    protected function buildData(SmsPushMessage $message)
    {
        $data = $message;

        return $data;
    }
}
