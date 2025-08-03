<?php

namespace Codebarista\LaravelWorkos\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Laravel\WorkOS\WorkOS;
use WorkOS\Exception\WorkOSException;
use WorkOS\Organizations;
use WorkOS\Resource\Organization;

class WorkosService
{
    public static string $workosTokenClaimsCacheKey = 'workos_token_claims';

    public static function setStripeCustomer(string $workosOrganizationId, string $stripeCustomerId): ?Organization
    {
        try {
            return app(Organizations::class)->updateOrganization(
                organization: $workosOrganizationId,
                stripeCustomerId: $stripeCustomerId
            );
        } catch (WorkOSException $exception) {
            Log::error($exception->getMessage(), $exception->getTrace());
        }

        return null;
    }

    public static function getTokenClaims(): array|bool
    {
        return Cache::flexible(self::$workosTokenClaimsCacheKey, [60, 600], static function () {
            if ($token = session(key: 'workos_access_token')) {
                return WorkOS::decodeAccessToken($token);
            }

            return false;
        });
    }
}
