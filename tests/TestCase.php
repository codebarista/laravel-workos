<?php

namespace Codebarista\LaravelWorkos\Tests;

use Codebarista\LaravelWorkos\LaravelWorkosServiceProvider;
use Codebarista\LaravelWorkos\Services\WorkosService;
use Codebarista\LaravelWorkos\Tests\Models\User;
use Illuminate\Support\Facades\Cache;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class TestCase extends OrchestraTestCase
{
    protected User $user;

    protected function getPackageProviders($app): array
    {
        return [
            LaravelWorkosServiceProvider::class,
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        Cache::flexible(WorkosService::$workosTokenClaimsCacheKey, [60, 600], [
            'iss' => 'https://api.workos.com',
            'sub' => 'user_01JYA6CX605TS76MS96H42MXYZ',
            'sid' => 'session_01K1GRV37VW9KS5RHSAY8XSMR9',
            'jti' => '01K1GSQG12W408QWTJAHMJTVVS',
            'org_id' => 'org_01JYA4MKH3VFHMX42RMMZ78XYZ',
            'role' => 'org-admin',
            'permissions' => [
                'users:delete',
                'users:write',
                'users:read',
            ], 'entitlements' => [
                'access-application',
                'access-feature',
            ], 'feature_flags' => [],
            'exp' => 1753984553,
            'iat' => 1753984253,
        ]);

        $this->user = new User(
            id: 'user_01JYA6CX605TS76MS96H42MXYZ',
            organizationId: 'org_01JYA4MKH3VFHMX42RMMZ78XYZ',
            firstName: 'Code',
            lastName: 'Barista',
            email: 'code@barista.test'
        );
    }
}
