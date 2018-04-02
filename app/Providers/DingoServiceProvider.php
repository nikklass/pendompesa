<?php
namespace App\Providers;

use Dingo\Api\Provider\LaravelServiceProvider;
use App\Exceptions\ApiExceptionsHandler as ExceptionHandler;

class DingoServiceProvider extends LaravelServiceProvider
{
    protected function registerExceptionHandler()
    {
        $this->app->singleton('api.exception', function ($app) {
            return new ExceptionHandler($app['Illuminate\Contracts\Debug\ExceptionHandler'], $this->config('errorFormat'), $this->config('debug'));
        });
    }
}