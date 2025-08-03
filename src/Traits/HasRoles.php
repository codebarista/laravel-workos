<?php

namespace Codebarista\LaravelWorkos\Traits;

use Illuminate\Support\Collection;

trait HasRoles
{
    public function roles(): Collection
    {
        return collect(workos_token_data_get(key: 'role'));
    }

    public function hasExactRoles(string ...$roles): bool
    {
        return $this->hasAllRoles(...$roles) && $this->roles()->count() === count($roles);
    }

    public function hasAllRoles(string ...$roles): bool
    {
        foreach ($roles as $role) {
            if (! $this->hasRole($role)) {
                return false;
            }
        }

        return true;
    }

    public function hasAnyRole(string ...$roles): bool
    {
        foreach ($roles as $role) {
            if ($this->hasRole($role)) {
                return true;
            }
        }

        return false;
    }

    public function hasRole(string $role): bool
    {
        return $this->roles()->contains($role);
    }
}
