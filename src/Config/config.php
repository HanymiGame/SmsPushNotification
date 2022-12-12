<?php
/**
 * @see https://github.com/hanymigame/SmsPushNotification
 */

return [
    'sms' => [
        'api_id' => '',
        'from' => null,
        'translit' => 0,
        'test' => 1,
        'partner_id' => null,
        'apiKey' => 'My_ApiKey',
    ],
    'gcm' => [
        'priority' => 'normal',
        'dry_run' => false,
        'apiKey' => 'My_ApiKey',
    ],
    'fcm' => [
        'priority' => 'normal',
        'dry_run' => false,
        'apiKey' => 'My_ApiKey',
    ],
    'apn' => [
        'certificate' => __DIR__ . '/iosCertificates/apns-dev-cert.pem',
        'passPhrase' => 'secret', //Optional
        'passFile' => __DIR__ . '/iosCertificates/yourKey.pem', //Optional
        'dry_run' => true, // dev and prod server
    ],
];
