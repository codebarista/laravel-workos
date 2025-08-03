<?php

test('user has permission to', function (string $permission): void {
    expect($this->user->hasPermissionTo($permission))->toBeTrue();
})
    ->with(['permissions' => [
        'users:delete',
        'users:write',
        'users:read',
    ]]);

test('user has any permission', function (string $permission): void {
    expect($this->user->hasAnyPermission($permission))->toBeTrue();
})
    ->with(['permissions' => [
        'users:delete',
        'users:write',
        'users:read',
    ]]);

test('user has exact permissions', function () {
    expect($this->user->hasExactPermissions('users:write', 'users:read', 'users:delete'))->toBeTrue();
});

test('user has all permissions', function () {
    expect($this->user->hasAllPermissions('users:write', 'users:read'))->toBeTrue();
});

test('user is missing at least one permission', function () {
    expect($this->user->hasExactPermissions('users:write', 'users:read'))->toBeFalse();
});
