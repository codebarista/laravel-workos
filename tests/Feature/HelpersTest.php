<?php

it('has the callable helpers', function () {
    expect('token_data_get')->toBeCallable();
});

it('handles empty token data', function () {
    expect(token_data_get(key: 'roles'))->toBeNull();
});
