<?php

namespace App\Enums;

enum RoleName: string
{
    case SUPER_ADMIN = 'super-admin';
    case ADMIN = 'admin';
    case DEVELOPER_DEVOPS = 'developer-devops';
    case CONTENT_MANAGER = 'content-manager';
    case SUPPORT_OPS = 'support-ops';
    case FINANCE_BILLING_MANAGER = 'finance-billing-manager';
    case AUDITOR_SECURITY = 'auditor-security';
    case VIEWER_GUEST = 'viewer-guest';

    public static function values(): array
    {
        return array_map(
            static fn (self $role): string => $role->value,
            self::cases(),
        );
    }
}
