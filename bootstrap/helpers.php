<?php

use Codebarista\LaravelWorkos\Services\TokenService;

if (! function_exists('token_data_get')) {
    function token_data_get(string $key): array|string|int|null
    {
        if ($token = TokenService::getAccessToken()) {
            return data_get($token, $key);
        }

        return null;
    }
}
