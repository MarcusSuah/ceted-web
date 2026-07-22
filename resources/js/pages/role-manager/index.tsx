import { Head } from '@inertiajs/react';
import roleManager from '@/routes/role-manager';

interface RoleRecord {
    id: number;
    name: string;
    guard_name: string;
    permissions: string[];
}

interface RoleManagerPageProps {
    roles: RoleRecord[];
}

export default function RoleManagerPage({ roles }: RoleManagerPageProps) {
    return (
        <>
            <Head title="Role Manager" />
            <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
                <div className="rounded-xl border border-sidebar-border/70 p-4 dark:border-sidebar-border">
                    <h1 className="text-2xl font-semibold">Role Management</h1>
                    <p className="mt-2 text-sm text-muted-foreground">Define the access model across the application.</p>
                </div>

                <div className="grid gap-4">
                    {roles.map((role) => (
                        <div key={role.id} className="rounded-xl border border-sidebar-border/70 p-4 dark:border-sidebar-border">
                            <div className="flex items-center justify-between gap-3">
                                <div>
                                    <h2 className="text-lg font-semibold">{role.name}</h2>
                                    <p className="text-sm text-muted-foreground">Guard: {role.guard_name}</p>
                                </div>
                            </div>
                            <div className="mt-3 flex flex-wrap gap-2">
                                {role.permissions.map((permission) => (
                                    <span key={`${role.id}-${permission}`} className="rounded-full bg-sidebar-accent/50 px-3 py-1 text-xs">
                                        {permission}
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

RoleManagerPage.layout = {
    breadcrumbs: [
        {
            title: 'Role Management',
            href: roleManager.index().url,
        },
    ],
};
