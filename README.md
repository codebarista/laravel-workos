# Laravel WorkOS

### User Roles, Permissions and Stripe Entitlements

The roles and permissions implementation is heavily inspired by _Spatie Laravel Permission_. The additional Stripe
entitlements are applied in the same way as permissions.

## 1. Installation

```shell
 composer require codebarista/laravel-workos
```

## 2. Configuration

### WorkOS

These variables should match the values provided to you in the WorkOS dashboard for your application:

```dotenv
WORKOS_REDIRECT_URL="${APP_URL}/authenticate"
WORKOS_CLIENT_ID=your-client-id
WORKOS_API_KEY=your-api-key
```

### Routes

```dotenv
LARAVEL_WORKOS_ROUTES_AUTHENTICATE=authenticate
LARAVEL_WORKOS_REDIRECT_TO_ROUTE_NAME=dashboard
LARAVEL_WORKOS_ROUTES_LOGOUT=logout
LARAVEL_WORKOS_ROUTES_LOGIN=login
```

### Publish config (optional)

```shell
php artisan vendor:publish --tag="config" --provider="Codebarista\LaravelWorkos\LaravelWorkosServiceProvider"
```

## 3. Implementation

Add the `HasRoles`, `HasPermissions` and `HasEntitlements` traits as needed to the User class, or any other that
uses authentication.

```php
namespace App\Models;

use Codebarista\LaravelWorkos\Traits\HasEntitlements;
use Codebarista\LaravelWorkos\Traits\HasPermissions;
use Codebarista\LaravelWorkos\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasEntitlements, HasPermissions, HasRoles;

    // ...
}
```

## 4. Usage

### WorkOS Role & Permissions

```php
// e.g. use in Laravel policies
class EntryPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('entries:view') // custom WorkOS permission
            || $user->hasRole('org-editor'); // custom WorkOS organization role
    }
    
    // ...
}
```

### Stripe Product Entitlements

#### Register Stripe customer for entitlements

```shell
php artisan codebarista:register-stripe-customer
```

#### Authorize with Stripe product entitlements

```php
// e.g. use in Laravel gates
protected function gate(): void
{
    Gate::define('viewNova', static function (User $user) {
        return $user->hasEntitlementTo('access-dashboard'); // custom Stripe entitlement
    });
}
```

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
