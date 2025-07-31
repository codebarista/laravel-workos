<?php

namespace Codebarista\LaravelWorkos\Services;

use Illuminate\Support\Facades\Log;
use WorkOS\Exception\WorkOSException;
use WorkOS\Organizations;
use WorkOS\Resource\Organization;

class WorkosService
{
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
}
