<?php

namespace HG\SmsPushNotification\Providers;

use HG\SmsPushNotification\SmsPushNotification;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class SmsPushNotificationServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $configPath = $this->app->make('path.config');

        $this->publishes([
            __DIR__.'/../Config/config.php' => $configPath.'/smspushnotification.php',
            __DIR__.'/../Config/iosCertificates' => $configPath.'/iosCertificates/',
        ], 'config');
    }

    /**
     * {@inheritdoc}
     */
    public function register()
    {
        $this->app->singleton('HGSmsPushNotification', function ($app) {
            return new SmsPushNotification();
        });

        $this->app->bind(SmsPushNotification::class, 'HGSmsPushNotification');
    }

    /**
     * {@inheritdoc}
     */
    public function provides()
    {
        return [
            SmsPushNotification::class,
            'HGSmsPushNotification',
        ];
    }
}
