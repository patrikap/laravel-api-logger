<?php

namespace Patrikap\ApiLogger;

use Illuminate\Support\ServiceProvider;

class ApiLoggerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/api-logger.php' => config_path('api-logger.php'),
            ], 'config');
        }
        $this->app->singleton(Contracts\LogProfile::class, config('api-logger.log_profile'));
        $this->app->singleton(Contracts\LogWriter::class, config('api-logger.log_writer'));
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/api-logger.php', 'api-logger');
        //
        $this->app->bind('request_id', function ($app) {
            return request()->header('X-ApiLogger-RequestId');
        });
        $this->app->bind('start_time', function ($app) {
            return request()->header('X-ApiLogger-StartTime');
        });
    }
}