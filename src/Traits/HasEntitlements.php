<?php

namespace Codebarista\LaravelWorkos\Traits;

use Illuminate\Support\Collection;

trait HasEntitlements
{
    public function entitlements(): Collection
    {
        return collect(workos_token_data_get(key: 'entitlements'));
    }

    public function hasExactEntitlements(string ...$entitlements): bool
    {
        return $this->hasAllEntitlements(...$entitlements) && $this->entitlements()->count() === count($entitlements);
    }

    public function hasAllEntitlements(string ...$entitlements): bool
    {
        foreach ($entitlements as $entitlement) {
            if (! $this->hasEntitlementTo($entitlement)) {
                return false;
            }
        }

        return true;
    }

    public function hasAnyEntitlement(string ...$entitlements): bool
    {
        foreach ($entitlements as $entitlement) {
            if ($this->hasEntitlementTo($entitlement)) {
                return true;
            }
        }

        return false;
    }

    public function hasEntitlementTo(string $entitlement): bool
    {
        return $this->entitlements()->contains($entitlement);
    }
}
