<?php

test('user has entitlement to', function (string $entitlement): void {
    expect($this->user->hasEntitlementTo($entitlement))->toBeTrue();
})
    ->with(['entitlements' => [
        'access-application',
        'access-feature',
    ]]);

test('user has any entitlement', function (string $entitlement): void {
    expect($this->user->hasAnyEntitlement($entitlement))->toBeTrue();
})
    ->with(['entitlements' => [
        'access-application',
        'access-feature',
    ]]);

test('user has exact entitlements', function () {
    expect($this->user->hasExactEntitlements('access-application', 'access-feature'))->toBeTrue();
});

test('user has all entitlements', function () {
    expect($this->user->hasAllEntitlements('access-feature'))->toBeTrue();
});

test('user is missing at least one entitlement', function () {
    expect($this->user->hasExactEntitlements('access-application'))->toBeFalse();
});
