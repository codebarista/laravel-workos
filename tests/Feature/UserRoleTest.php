<?php

test('user has the role of organization admin', function () {
    expect($this->user->hasRole('org-admin'))->toBeTrue();
});

test('user has any role', function () {
    expect($this->user->hasAnyRole('org-admin', 'org-editor'))->toBeTrue();
});

test('user has exact roles', function () {
    expect($this->user->hasExactRoles('org-admin'))->toBeTrue();
});

test('user has all roles', function () {
    expect($this->user->hasAllRoles('org-admin'))->toBeTrue();
});

test('user has at least one different role', function () {
    expect($this->user->hasExactRoles('org-admin', 'org-editor'))->toBeFalse();
});

test('user is missing at least one role', function () {
    expect($this->user->hasAllRoles('org-admin', 'org-editor'))->toBeFalse();
});
