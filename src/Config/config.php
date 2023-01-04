<?php
/**
 * @see https://github.com/hanymigame/SmsPushNotification
 */

return [
    'sms' => [
        'api_id' => env('SMSPUSH_SMS_API_ID', ''),
        'from' => env('SMSPUSH_SMS_FROM', null),
        'translit' => env('SMSPUSH_SMS_TRANS', 0),
        'test' => env('SMSPUSH_SMS_TEST', 1),
        'partner_id' => env('SMSPUSH_SMS_PARTNER', null),
        'apiKey' => env('SMSPUSH_SMS_API', 'My_ApiKey'),
        'timeout' => env('SMSPUSH_SMS_TIMEOUT', 0),
    ],
    'gcm' => [
        'priority' => env('SMSPUSH_GCM_PRIORITY', 'normal'),
        'dry_run' => env('SMSPUSH_GCM_DEV', false),
        'apiKey' => env('SMSPUSH_GCM_API', 'My_ApiKey'),
        'timeout' => env('SMSPUSH_GCM_TIMEOUT', 0),
    ],
    'fcm' => [
        'priority' => env('SMSPUSH_FCM_PRIORITY', 'normal'),
        'dry_run' => env('SMSPUSH_FCM_DEV', false),
        'apiKey' => env('SMSPUSH_FCM_API', 'My_ApiKey'),
        'timeout' => env('SMSPUSH_FCM_TIMEOUT', 0),
    ],
    'apn' => [
        'certificate' => __DIR__ . '/iosCertificates/'.env('SMSPUSH_APN_CERT', 'apns-dev-cert.pem'),
        'passPhrase' => env('SMSPUSH_APN_PASSPHRASE', 'secret'), //Optional
        'passFile' => __DIR__ . '/iosCertificates/'.env('SMSPUSH_APN_PASSFILE', 'yourKey.pem'), //Optional
        'dry_run' => env('SMSPUSH_APN_DEV', true), // dev and prod server
        'apns_topic' => env('SMSPUSH_APN_TOPIC', ''),
        'timeout' => env('SMSPUSH_APN_TIMEOUT', 0),
    ],
];
