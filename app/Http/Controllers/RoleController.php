<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Role::query();

        $query->when(request('search'), function ($q, $search) {
            $q->where('name', 'like', "%{$search}%");
        });

        $roles = $query->paginate(10)->withQueryString();
        $roles->load('permissions');

        // dd($roles);


        return Inertia::render('Roles/Index', [
            'roles' => $roles,
            'filters' => request()->only('search'),
        ]);

        // return Inertia::render('Roles/Index', [
        //     'roles' => Role::all(),
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Roles/Create',[
            'permissions' => Permission::pluck('name')->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:50',
            'permissions' => 'required'
        ]);

        $role = Role::create(['name'=>$request->name]);
        $role->syncPermissions($request->permissions);

        return to_route('roles.index')->with('success', 'Role created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return Inertia::render('Roles/Show', [
            'role' => $role,
            'rolePermissions' => $role->permissions()->pluck('name')->all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return Inertia::render('Roles/Edit', [
            'role' => $role,
            'rolePermissions' => $role->permissions()->pluck('name')->all(),
            'permissions' => Permission::pluck('name')->all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'permissions' => 'required'
        ]);
        $role->name = $request->name;
        $role->save();

        $role->syncPermissions($request->permissions);

        return to_route('roles.index')->with('success', 'Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return to_route('roles.index')->with('success', 'Role deleted successfully.');
    }
}
