<?php

namespace App\Http\Controllers\Management;

use App\Enums\PermissionName;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;

class PermissionManagerController extends Controller
{
    public function index(Request $request)
    {
        $request->user()?->can(PermissionName::MANAGE_PERMISSIONS->value)
            ? null
            : abort(403);

        return Inertia::render('permission-manager/index', [
            'permissions' => Permission::query()
                ->with('roles:id,name')
                ->get()
                ->map(fn (Permission $permission) => [
                    'id' => $permission->id,
                    'name' => $permission->name,
                    'guard_name' => $permission->guard_name,
                    'roles' => $permission->roles->pluck('name')->all(),
                ]),
        ]);
    }
}
