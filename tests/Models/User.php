<?php

namespace Codebarista\LaravelWorkos\Tests\Models;

use Codebarista\LaravelWorkos\Traits\HasEntitlements;
use Codebarista\LaravelWorkos\Traits\HasPermissions;
use Codebarista\LaravelWorkos\Traits\HasRoles;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Str;

class User extends \Laravel\WorkOS\User implements Authenticatable
{
    use HasEntitlements, HasPermissions, HasRoles;

    public function getAuthIdentifierName(): string
    {
        return 'email';
    }

    public function getAuthIdentifier(): string
    {
        return $this->email;
    }

    public function getAuthPasswordName(): string
    {
        return 'password';
    }

    public function getAuthPassword(): string
    {
        return 'password';
    }

    public function getRememberToken(): string
    {
        return Str::random();
    }

    public function setRememberToken($value): void {}

    public function getRememberTokenName(): string
    {
        return 'remember_token';
    }
}
