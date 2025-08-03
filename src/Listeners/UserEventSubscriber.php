<?php

namespace Codebarista\LaravelWorkos\Listeners;

use Codebarista\LaravelWorkos\Services\WorkosService;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Cache;

class UserEventSubscriber
{
    public function handleUserLogout(): void
    {
        Cache::forget(WorkosService::$workosTokenClaimsCacheKey);
    }

    public function subscribe(): array
    {
        return [
            Logout::class => 'handleUserLogout',
        ];
    }
}
