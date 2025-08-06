<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RoleController extends Controller
{
    
    public function index()
    {
        $roles = Role::all();
        return Inertia::render('admin/Role/Index', [
            'roles' => $roles,
        ]);
    }

    public function create()
    {
        return Inertia::render('admin/Role/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
        ]);

                Role::create([
        'name' => $request->name,
        'guard_name' => 'web', // ← ini WAJIB
    ]);


        return redirect()->route('roles.index')->with('success', 'Role berhasil ditambahkan.');
    }

    public function edit(Role $role)
    {
        return Inertia::render('admin/Role/Edit', [
            'role' => $role
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|max:100',
        ]);

        $role->update($request->only('name', 'description'));

        return redirect()->route('roles.index')->with('success', 'Role berhasil diperbarui.');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Role berhasil dihapus.');
    }
}
