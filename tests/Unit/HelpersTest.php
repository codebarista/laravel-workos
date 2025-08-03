<?php

it('has the callable helpers', function () {
    expect('workos_token_data_get')->toBeCallable();
});

it('handles empty token data', function () {
    expect(workos_token_data_get(key: 'user'))->toBeNull();
});
