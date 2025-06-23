<?php

namespace Codebarista\LaravelWorkos\Traits;

use Illuminate\Support\Collection;

trait HasRoles
{
    public function roles(): Collection
    {
        return collect(token_data_get(key: 'role'));
    }

    public function hasExactRoles(string ...$roles): bool
    {
        return $this->roles()->intersect($roles)->count() === count($roles);
    }

    public function hasAllRoles(string ...$roles): bool
    {
        return $this->roles()->intersect($roles)->all() === $roles;
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
