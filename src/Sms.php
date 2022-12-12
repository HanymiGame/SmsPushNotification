<?php

namespace HG\SmsPushNotification;

use HG\SmsPushNotification\Contracts\SmsPushServiceInterface;
use GuzzleHttp\Client;

class Sms extends SmsPushService implements SmsPushServiceInterface
{

    /**
     * Set the apiKey for the notification
     * @param string $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->config['api_id'] = $apiKey;
    }

    /**
     * Client to do the request
     *
     * @var \GuzzleHttp\Client $client
     */
    protected $client;

    /**
     * Gcm constructor.
     */
    public function __construct()
    {
        $this->url = 'https://sms.ru/sms/send';

        $this->config = $this->initializeConfig('sms');
        $this->client = new Client;
    }

    /**
     * Provide the unregistered tokens of the sent notification.
     *
     * @param array $devices_token
     * @return array $tokenUnRegistered
     */
    public function getUnregisteredDeviceTokens(array $devices_token)
    {
        return [];
    }

    /**
     * Set the needed fields for the push notification
     *
     * @return string
     */
    protected function addRequestFields(): string
    {
        return http_build_query($this->config);
    }

    /**
     * Build message to.
     *
     * @param array $devices_token
     * @param array $message
     * @return array $params
     */
    protected function buildMessageTo($deviceTokens, $message)
    {
        $params['to'] = implode(', ', $deviceTokens);
        $params['msg'] = $message[0];
        return $params;
    }

    /**
     * Send Push Notification
     *
     * @param array $deviceTokens
     * @param array $message
     *
     * @return \stdClass  GCM Response
     */
    public function send(array $deviceTokens, array $message)
    {

        $fields = $this->addRequestFields();
        $params = $this->buildMessageTo($deviceTokens, $message);

        try {
            $result = $this->client->request('POST', $this->url . '?json=1&' . $fields, [
                'form_params' => $params,
                // If you want more informations during request
                'debug' => false
            ]);

            $json = $result->getBody();

            $this->setFeedback(json_decode($json, false, 512, JSON_BIGINT_AS_STRING));

            return $this->feedback;

        } catch (\Exception $e) {
            $response = ['success' => false, 'error' => $e->getMessage()];

            $this->setFeedback(json_decode(json_encode($response)));

            return $this->feedback;
        }
    }
}
