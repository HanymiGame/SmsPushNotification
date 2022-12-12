<?php namespace HG\SmsPushNotification\Facades;

use Illuminate\Support\Facades\Facade;

class SmsPushNotification extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'HGSmsPushNotification';
    }
}
