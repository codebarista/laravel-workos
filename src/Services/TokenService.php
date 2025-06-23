<?php

namespace Codebarista\LaravelWorkos\Services;

use Illuminate\Support\Facades\Cache;
use Laravel\WorkOS\WorkOS;

class TokenService
{
    public static function getAccessToken(): array|bool
    {
        return Cache::flexible('laravel_workos_access_token', [60, 600], static function () {
            if ($token = session(key: 'workos_access_token')) {
                return WorkOS::decodeAccessToken($token);
            }

            return false;
        });
    }
}
