<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ValidationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        
        $this->app['validator']->extend('phone_number_check', function ($attribute, $value, $parameters)
        {
            
            if (is_array($value)) {
                foreach ($value as $v) {
                    if (!isValidPhoneNumber($v)) {
                        return false;
                    }
                }
            } else {
                if (!isValidPhoneNumber($value)) {
                    return false;
                }
            }
            return true;
        });

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
