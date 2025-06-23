<?php

namespace Codebarista\LaravelWorkos\Traits;

use Illuminate\Support\Collection;

trait HasEntitlements
{
    public function entitlements(): Collection
    {
        return collect(token_data_get(key: 'entitlements'));
    }

    public function hasAllEntitlements(string ...$entitlements): bool
    {
        return $this->entitlements()->intersect($entitlements)->all() === $entitlements;
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
