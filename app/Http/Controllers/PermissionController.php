<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
{
     $query = Permission::query();

    $query->when(request('search'), function ($q, $search) {
        $q->where('name', 'like', "%{$search}%");
    });

    $permissions = $query->paginate(10)->withQueryString();


    return Inertia::render('Permissions/Index', [
        'permissions' => $permissions,
        'filters' => request()->only('search'),
    ]);
    }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();

        return to_route('permissions.index')->with('success', 'Permission: '.$permission->name.' deleted successfully.');
    }
}
