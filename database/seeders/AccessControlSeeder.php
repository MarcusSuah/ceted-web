<?php

namespace Database\Seeders;

use App\Enums\PermissionName;
use App\Enums\RoleName;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AccessControlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (PermissionName::cases() as $permission) {
            Permission::query()->firstOrCreate([
                'name' => $permission->value,
                'guard_name' => 'web',
            ]);
        }

        $rolePermissions = [
            RoleName::SUPER_ADMIN->value => PermissionName::values(),
            RoleName::ADMIN->value => [
                PermissionName::MANAGE_USERS->value,
                PermissionName::VIEW_USERS->value,
                PermissionName::MANAGE_ROLES->value,
                PermissionName::VIEW_ROLES->value,
                PermissionName::MANAGE_PERMISSIONS->value,
                PermissionName::VIEW_PERMISSIONS->value,
                PermissionName::MANAGE_CONTENT->value,
                PermissionName::MANAGE_SUPPORT->value,
                PermissionName::MANAGE_FINANCE->value,
                PermissionName::VIEW_AUDIT->value,
            ],
            RoleName::DEVELOPER_DEVOPS->value => [
                PermissionName::VIEW_USERS->value,
                PermissionName::VIEW_ROLES->value,
                PermissionName::VIEW_PERMISSIONS->value,
                PermissionName::MANAGE_SUPPORT->value,
            ],
            RoleName::CONTENT_MANAGER->value => [
                PermissionName::VIEW_USERS->value,
                PermissionName::MANAGE_CONTENT->value,
            ],
            RoleName::SUPPORT_OPS->value => [
                PermissionName::VIEW_USERS->value,
                PermissionName::MANAGE_SUPPORT->value,
            ],
            RoleName::FINANCE_BILLING_MANAGER->value => [
                PermissionName::VIEW_USERS->value,
                PermissionName::MANAGE_FINANCE->value,
            ],
            RoleName::AUDITOR_SECURITY->value => [
                PermissionName::VIEW_USERS->value,
                PermissionName::VIEW_ROLES->value,
                PermissionName::VIEW_PERMISSIONS->value,
                PermissionName::VIEW_AUDIT->value,
            ],
            RoleName::VIEWER_GUEST->value => [
                PermissionName::VIEW_USERS->value,
                PermissionName::VIEW_ROLES->value,
                PermissionName::VIEW_PERMISSIONS->value,
            ],
        ];

        $roles = [];

        foreach (RoleName::cases() as $role) {
            $roles[$role->value] = Role::query()->firstOrCreate([
                'name' => $role->value,
                'guard_name' => 'web',
            ]);
        }

        foreach ($rolePermissions as $roleValue => $permissions) {
            $roles[$roleValue]->syncPermissions($permissions);
        }

        $superAdmin = User::query()->firstOrCreate(
            ['email' => 'superadmin@example.com'],
            [
                'name' => 'Super Admin',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
            ],
        );
        $superAdmin->syncRoles(RoleName::SUPER_ADMIN->value);

        $admin = User::query()->firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
            ],
        );
        $admin->syncRoles(RoleName::ADMIN->value);

        $viewer = User::query()->firstOrCreate(
            ['email' => 'viewer@example.com'],
            [
                'name' => 'Viewer User',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
            ],
        );
        $viewer->syncRoles(RoleName::VIEWER_GUEST->value);
    }
}
