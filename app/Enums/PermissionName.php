<?php

namespace App\Enums;

enum PermissionName: string
{
    case MANAGE_USERS = 'users.manage';
    case VIEW_USERS = 'users.view';
    case MANAGE_ROLES = 'roles.manage';
    case VIEW_ROLES = 'roles.view';
    case MANAGE_PERMISSIONS = 'permissions.manage';
    case VIEW_PERMISSIONS = 'permissions.view';
    case MANAGE_CONTENT = 'content.manage';
    case MANAGE_SUPPORT = 'support.manage';
    case MANAGE_FINANCE = 'finance.manage';
    case VIEW_AUDIT = 'audit.view';

    public static function values(): array
    {
        return array_map(
            static fn (self $permission): string => $permission->value,
            self::cases(),
        );
    }
}
