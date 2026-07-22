<?php

namespace App\Http\Controllers\Management;

use App\Enums\PermissionName;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserManagerController extends Controller
{
    public function index(Request $request)
    {
        $request->user()?->can(PermissionName::MANAGE_USERS->value)
            ? null
            : abort(403);

        return Inertia::render('user-manager/index', [
            'users' => User::query()
                ->with('roles:id,name')
                ->get()
                ->map(fn (User $user) => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'roles' => $user->roles->pluck('name')->all(),
                ]),
        ]);
    }
}
