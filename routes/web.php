<?php

use App\Enums\PermissionName;
use App\Http\Controllers\Management\PermissionManagerController;
use App\Http\Controllers\Management\RoleManagerController;
use App\Http\Controllers\Management\UserManagerController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'dashboard')->name('dashboard');

    Route::middleware(['permission:'.PermissionName::MANAGE_USERS->value])
        ->group(function () {
            Route::get('users/manager', [UserManagerController::class, 'index'])->name('user-manager.index');
        });

    Route::middleware(['permission:'.PermissionName::MANAGE_ROLES->value])
        ->group(function () {
            Route::get('roles/manager', [RoleManagerController::class, 'index'])->name('role-manager.index');
        });

    Route::middleware(['permission:'.PermissionName::MANAGE_PERMISSIONS->value])
        ->group(function () {
            Route::get('permissions/manager', [PermissionManagerController::class, 'index'])->name('permission-manager.index');
        });
});

require __DIR__.'/settings.php';
