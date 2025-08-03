<?php

use Codebarista\LaravelWorkos\Services\WorkosService;

if (! function_exists('workos_token_data_get')) {
    function workos_token_data_get(string $key): array|string|int|null
    {
        if ($claims = WorkosService::getTokenClaims()) {
            return data_get($claims, $key);
        }

        return null;
    }
}
