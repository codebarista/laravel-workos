<?php

namespace Codebarista\LaravelWorkos\Traits;

use Illuminate\Support\Collection;

trait HasPermissions
{
    public function permissions(): Collection
    {
        return collect(workos_token_data_get(key: 'permissions'));
    }

    public function hasExactPermissions(string ...$permissions): bool
    {
        return $this->hasAllPermissions(...$permissions) && $this->permissions()->count() === count($permissions);
    }

    public function hasAllPermissions(string ...$permissions): bool
    {
        foreach ($permissions as $permission) {
            if (! $this->hasPermissionTo($permission)) {
                return false;
            }
        }

        return true;
    }

    public function hasAnyPermission(string ...$permissions): bool
    {
        foreach ($permissions as $permission) {
            if ($this->hasPermissionTo($permission)) {
                return true;
            }
        }

        return false;
    }

    public function hasPermissionTo(string $permission): bool
    {
        return $this->permissions()->contains($permission);
    }
}
