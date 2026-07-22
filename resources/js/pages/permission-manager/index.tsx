import { Head } from '@inertiajs/react';
import permissionManager from '@/routes/permission-manager';

interface PermissionRecord {
    id: number;
    name: string;
    guard_name: string;
    roles: string[];
}

interface PermissionManagerPageProps {
    permissions: PermissionRecord[];
}

export default function PermissionManagerPage({ permissions }: PermissionManagerPageProps) {
    return (
        <>
            <Head title="Permission Manager" />
            <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
                <div className="rounded-xl border border-sidebar-border/70 p-4 dark:border-sidebar-border">
                    <h1 className="text-2xl font-semibold">Permission Management</h1>
                    <p className="mt-2 text-sm text-muted-foreground">Review permission names and the roles they belong to.</p>
                </div>

                <div className="grid gap-4">
                    {permissions.map((permission) => (
                        <div key={permission.id} className="rounded-xl border border-sidebar-border/70 p-4 dark:border-sidebar-border">
                            <div className="flex items-center justify-between gap-3">
                                <div>
                                    <h2 className="text-lg font-semibold">{permission.name}</h2>
                                    <p className="text-sm text-muted-foreground">Guard: {permission.guard_name}</p>
                                </div>
                            </div>
                            <div className="mt-3 flex flex-wrap gap-2">
                                {permission.roles.map((role) => (
                                    <span key={`${permission.id}-${role}`} className="rounded-full bg-sidebar-accent/50 px-3 py-1 text-xs">
                                        {role}
                                    </span>
                                ))}
                            </div>
                        </div>
                    ))}
                </div>
            </div>
        </>
    );
}

PermissionManagerPage.layout = {
    breadcrumbs: [
        {
            title: 'Permission Management',
            href: permissionManager.index().url,
        },
    ],
};
