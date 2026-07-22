<?php

namespace App\Http\Controllers\Management;

use App\Enums\PermissionName;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class RoleManagerController extends Controller
{
    public function index(Request $request)
    {
        $request->user()?->can(PermissionName::MANAGE_ROLES->value)
            ? null
            : abort(403);

        return Inertia::render('role-manager/index', [
            'roles' => Role::query()
                ->with('permissions:id,name')
                ->get()
                ->map(fn (Role $role) => [
                    'id' => $role->id,
                    'name' => $role->name,
                    'guard_name' => $role->guard_name,
                    'permissions' => $role->permissions->pluck('name')->all(),
                ]),
        ]);
    }
}
