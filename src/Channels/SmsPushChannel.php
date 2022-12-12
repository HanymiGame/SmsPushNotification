<?php
namespace HG\SmsPushNotification\Channels;

use HG\SmsPushNotification\Events\NotificationPushed;
use HG\SmsPushNotification\Messages\SmsPushMessage;
use HG\SmsPushNotification\SmsPushNotification;
use Illuminate\Notifications\Notification;

abstract class SmsPushChannel
{
    /**
     * @var \HG\SmsPushNotification\SmsPushNotification
     */
    protected $push;

    /**
     * Create a new Apn channel instance.
     *
     * @param  \HG\SmsPushNotification\SmsPushNotification $push
     */
    public function __construct(SmsPushNotification $push)
    {
        $this->push = $push;
    }

    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $this->buildMessage($notifiable, $notification);
        $data = $this->buildData($message);
        $to = $message->to ?? $notifiable->routeNotificationFor($this->notificationFor());

        if (! $to) {
            return;
        }

        $this->push($this->pushServiceName(), $to, $data, $message);
    }

    /**
     * Send the push notification.
     *
     * @param  string $service
     * @param  mixed $to
     * @param  array $data
     * @param  \HG\SmsPushNotification\Messages\SmsPushMessage $message
     * @return mixed
     */
    protected function push($service, $to, $data, SmsPushMessage $message)
    {
        $this->push->setMessage($data)
            ->setService($service)
            ->setDevicesToken($to);

        if (! empty($message->config)) {
            $this->push->setConfig($message->config);

            if (! empty($message->config['apiKey'])) {
                $this->push->setApiKey($message->config['apiKey']);
            }
        }

        $feedback = $this->push->send()
            ->getFeedback();

        $this->broadcast();

        return $feedback;
    }

    /**
     * Format the message.
     *
     * @param  mixed $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return \HG\SmsPushNotification\Messages\SmsPushMessage
     */
    protected function buildMessage($notifiable, Notification $notification)
    {
        $message = call_user_func_array([$notification, $this->getToMethod()], [$notifiable]);

        if (is_string($message)) {
            $message = new SmsPushMessage($message);
        }

        return $message;
    }

    /**
     * Get the method name to get the push notification representation of the notification.
     *
     * @return string
     */
    protected function getToMethod()
    {
        return 'to' . ucfirst($this->pushServiceName());
    }

    /**
     * Format push service name for routing notification.
     *
     * @return string
     */
    protected function notificationFor()
    {
        return ucfirst(strtolower($this->pushServiceName()));
    }

    /**
     * Build the push payload data.
     *
     * @param  \HG\SmsPushNotification\Messages\SmsPushMessage $message
     * @return array
     */
    abstract protected function buildData(SmsPushMessage $message);

    /**
     * BroadCast NotificationPushed event
     */
    protected function broadcast()
    {
        if (function_exists('broadcast')) {
            broadcast(new NotificationPushed($this->push));
        } elseif (function_exists('event')) {
            event(new NotificationPushed($this->push));
        }
    }

    /**
     * Get push notification service name.
     *
     * @return string
     */
    abstract protected function pushServiceName();

}
