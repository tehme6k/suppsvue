<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = User::query();

        $query->when(request('search'), function ($q, $search) {
            $q->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        });

        $users = $query->paginate(10)->withQueryString();
        $users->load('roles');

        return Inertia::render('Users/Index', [
            'users' => $users,
            'filters' => request()->only('search'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Users/Create', [
            'roles' => Role::pluck('name')->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create(
            $request->only(['name', 'email']) +
                ['password' => Hash::make($request->password)]
        );
        $user->syncRoles($request->roles);

        // Log the activity
        // activity()
        //     ->performedOn($user)
        //     ->causedBy(auth()->user()) // Assuming a logged-in user caused the action
        //     ->withProperties(
        //         [
        //             'role' => $request->roles                    
        //         ])
        //     ->log('Role assigned to user');


        return to_route('users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return Inertia::render('Users/Show', [
            'user' => $user,
            'userRoles' => $user->roles()->pluck('name')->all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return Inertia::render('Users/Edit', [
            'user' => $user,
            'userRoles' => $user->roles()->pluck('name')->all(),
            'roles' => Role::pluck('name')->all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($user->save()) {
            if ($user->syncRoles($request->roles)) {
                // activity()
                //     ->performedOn($user)
                //     ->causedBy(auth()->user()) // Assuming a logged-in user caused the action
                //     ->withProperties(['role' => $request->roles])
                //     ->log('Role assigned to user');

                return to_route('users.index')->with('success', 'User updated successfully.');
            }
        }else{
            return to_route('users.index')->with('error', 'User not updated.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return to_route('users.index')->with('success', 'User deleted successfully.');
    }
}
