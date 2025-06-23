<?php

namespace Codebarista\LaravelWorkos\Traits;

use Illuminate\Support\Collection;

trait HasPermissions
{
    public function permissions(): Collection
    {
        return collect(token_data_get(key: 'permissions'));
    }

    public function hasAllPermissions(string ...$permissions): bool
    {
        return $this->permissions()->intersect($permissions)->all() === $permissions;
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
