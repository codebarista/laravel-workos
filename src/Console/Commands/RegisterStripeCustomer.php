<?php

namespace Codebarista\LaravelWorkos\Console\Commands;

use Codebarista\LaravelWorkos\Services\WorkosService;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Support\Str;

class RegisterStripeCustomer extends Command implements PromptsForMissingInput
{
    protected $signature = 'codebarista:register-stripe-customer {workos_organization_id} {stripe_customer_id}';

    protected $description = 'Register a Stripe customer ID on a WorkOS organization for entitlements';

    protected function promptForMissingArgumentsUsing(): array
    {
        return [
            'workos_organization_id' => [
                'Which WorkOS organization ID should be used?',
                'e.g. org_01JYA4MKH3VFX4RRMMZ78SV5',
            ],
            'stripe_customer_id' => [
                'Which Stripe customer ID should be registered?',
                'e.g. cus_SXhCbaXMk6wExe',
            ],
        ];
    }

    public function handle(): int
    {
        $workosOrganizationId = $this->argument('workos_organization_id');

        if (! Str::startsWith($workosOrganizationId, 'org_')) {
            $this->components->error('WorkOS organization ID must start with "org_"');

            return self::FAILURE;
        }

        $stripeCustomerId = $this->argument('stripe_customer_id');

        if (! Str::startsWith($stripeCustomerId, 'cus_')) {
            $this->components->error('Stripe customer ID must start with "cus_"');

            return self::FAILURE;
        }

        if ($organization = WorkosService::setStripeCustomer(
            workosOrganizationId: $workosOrganizationId,
            stripeCustomerId: $stripeCustomerId
        )) {
            $organizationName = data_get($organization->raw, 'name');
            $this->components->success(
                string: 'Stripe customer ID has been registered for '.$organizationName
            );

            return self::SUCCESS;
        }

        return self::FAILURE;
    }
}
