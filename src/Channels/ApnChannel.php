<?php

namespace HG\SmsPushNotification\Channels;

use HG\SmsPushNotification\Messages\SmsPushMessage;

class ApnChannel extends SmsPushChannel
{
    /**
     * {@inheritdoc}
     */
    protected function pushServiceName()
    {
        return 'apn';
    }

    /**
     * {@inheritdoc}
     */
    protected function buildData(SmsPushMessage $message)
    {
        $data = [
            'aps' => [
                'alert' => [
                    'title' => $message->title,
                    'body' => $message->body,
                ],
                'category' => $message->category,
                'sound' => $message->sound,
            ],
        ];

        if (! empty($message->extra)) {
            $data['extraPayLoad'] = $message->extra;
        }

        if (is_numeric($message->badge)) {
            $data['aps']['badge'] = $message->badge;
        }

        return $data;
    }
}
