<?php

namespace Codebarista\LaravelWorkos;

use Codebarista\LaravelWorkos\Console\Commands\RegisterStripeCustomer;
use Codebarista\LaravelWorkos\Listeners\UserEventSubscriber;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class LaravelWorkosServiceProvider extends ServiceProvider
{
    private string $configPath = __DIR__.'/../config/laravel-workos.php';

    private string $configKey = 'laravel-workos';

    public function boot(): void
    {
        Route::middleware(config('laravel-workos.middleware', default: 'web'))->group(function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        });

        if ($this->app->runningInConsole()) {
            $this->publishes([
                $this->configPath => config_path($this->configKey.'.php'),
            ], groups: 'config');

            $this->commands([
                RegisterStripeCustomer::class,
            ]);
        }

        Event::subscribe(UserEventSubscriber::class);
    }

    public function register(): void
    {
        $this->mergeConfigFrom($this->configPath, $this->configKey);
    }
}
