<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Activitylog\Models\Activity;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $activities = Activity::with('causer')->latest()->paginate(10);

        // return Inertia::render('Activities/Index', [
        //     'activities' => $activities,
        //     'filters' => request()->only('search'),
        // ]);

        $query = Activity::with('causer', 'subject')->latest();

        $query->when(request('search'), function ($q, $search) {
            $q->where('description', 'like', "%{$search}%")
                ->orWhere('subject_type', 'like', "%{$search}%")
                ->orWhere('event', 'like', "%{$search}%")
                ->orWhere('properties', 'like', "%{$search}%")
                ->orWhereHas('causer', function ($query) use ($search) {
                    $query->where('name', 'LIKE', "%{$search}%");
                });
        });

        $activity = $query->paginate(10)->withQueryString();
        // $activity->load('causer')->latest();
        // $users->load('roles');

        // dd($activity);

        return Inertia::render('Activities/Index', [
            'activities' => $activity,
            'filters' => request()->only('search'),
        ]);
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
    public function destroy(string $id)
    {
        //
    }
}
