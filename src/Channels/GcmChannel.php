<?php

namespace HG\SmsPushNotification\Channels;

use HG\SmsPushNotification\Messages\SmsPushMessage;

class GcmChannel extends SmsPushChannel
{
    /**
     * {@inheritdoc}
     */
    protected function pushServiceName()
    {
        return 'gcm';
    }

    /**
     * {@inheritdoc}
     */
    protected function buildData(SmsPushMessage $message)
    {
        $data = [];
        if ($message->title != null || $message->body != null || $message->click_action != null) {
            $data = [
                'notification' => [
                    'title' => $message->title,
                    'body' => $message->body,
                    'sound' => $message->sound,
                    'color' => $message->color,
                    'click_action' => $message->click_action,
                ],
            ];

            // Set custom badge number when isset in SmsPushMessage
            if (! empty($message->badge)) {
                $data['notification']['badge'] = $message->badge;
            }

            // Set icon when isset in SmsPushMessage
            if (! empty($message->icon)) {
                $data['notification']['icon'] = $message->icon;
            }
        }

        if (! empty($message->extra)) {
            $data['data'] = $message->extra;
        }

        return $data;
    }
}
