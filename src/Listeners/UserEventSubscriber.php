<?php

namespace Codebarista\LaravelWorkos\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Cache;

class UserEventSubscriber
{
    public function handleUserLogout(Logout $event): void
    {
        Cache::forget('laravel_workos_access_token');
    }

    public function subscribe(Dispatcher $events): array
    {
        return [
            Logout::class => 'handleUserLogout',
        ];
    }
}
