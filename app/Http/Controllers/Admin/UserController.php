<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('manage-users');

        $query = User::query();

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
        }

        $users = $query->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        $this->authorize('manage-users');

        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $this->authorize('manage-users');

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|exists:roles,name',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $user->syncRoles([$request->role]);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function toggleStatus(User $user)
    {
        $this->authorize('manage-users');

        $user->update(['is_active' => !$user->is_active]);
        return back()->with('success', 'User status updated successfully.');
    }

    public function changeRole(Request $request, User $user)
    {
        $this->authorize('manage-roles');

        $request->validate([
            'role' => 'required|exists:roles,name',
        ]);

        $user->syncRoles([$request->role]);

        return back()->with('success', 'User role updated successfully.');
    }
}