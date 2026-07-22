import { Head } from '@inertiajs/react';
import userManager from '@/routes/user-manager';

interface UserRecord {
    id: number;
    name: string;
    email: string;
    roles: string[];
}

interface UserManagerPageProps {
    users: UserRecord[];
}

export default function UserManagerPage({ users }: UserManagerPageProps) {
    return (
        <>
            <Head title="User Manager" />
            <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
                <div className="rounded-xl border border-sidebar-border/70 p-4 dark:border-sidebar-border">
                    <h1 className="text-2xl font-semibold">User Management</h1>
                    <p className="mt-2 text-sm text-muted-foreground">Review users and their assigned role groups.</p>
                </div>

                <div className="overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <table className="min-w-full divide-y divide-sidebar-border/70 text-left text-sm">
                        <thead className="bg-sidebar-accent/40">
                            <tr>
                                <th className="px-4 py-3 font-medium">Name</th>
                                <th className="px-4 py-3 font-medium">Email</th>
                                <th className="px-4 py-3 font-medium">Roles</th>
                            </tr>
                        </thead>
                        <tbody className="divide-y divide-sidebar-border/70">
                            {users.map((user) => (
                                <tr key={user.id}>
                                    <td className="px-4 py-3">{user.name}</td>
                                    <td className="px-4 py-3">{user.email}</td>
                                    <td className="px-4 py-3">{user.roles.join(', ') || '—'}</td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                </div>
            </div>
        </>
    );
}

UserManagerPage.layout = {
    breadcrumbs: [
        {
            title: 'User Management',
            href: userManager.index().url,
        },
    ],
};
