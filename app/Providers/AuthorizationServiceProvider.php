<?php

namespace App\Providers;

use App\Enums\PermissionName;
use App\Enums\RoleName;
use App\Http\Middleware\EnsurePermission;
use App\Http\Middleware\EnsureRole;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AuthorizationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::before(function (User $user, string $ability): ?bool {
            if ($user->hasRole(RoleName::SUPER_ADMIN->value)) {
                return true;
            }

            return null;
        });

        foreach (PermissionName::cases() as $permission) {
            Gate::define($permission->value, fn (User $user): bool => $user->can($permission->value));
        }

        Route::aliasMiddleware('role', EnsureRole::class);
        Route::aliasMiddleware('permission', EnsurePermission::class);
    }
}
