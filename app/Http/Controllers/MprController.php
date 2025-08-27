<?php

namespace App\Http\Controllers;

use App\Models\Mpr;
use App\Http\Requests\StoreMprRequest;
use App\Http\Requests\UpdateMprRequest;
use App\Models\Project;
use Inertia\Inertia;
use Spatie\Activitylog\Facades\Activity;

class MprController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Mpr::query();

        $query->when(request('search'), function ($q, $search) {
            $q->where('version_nbr', 'like', "%{$search}%")
                ->orWhereHas('project', function ($query) use ($search) {
                    $query->where('name', 'LIKE', "%{$search}%");
                })->orWhereHas('project', function ($query) use ($search) {
                    $query->where('descriptor', 'LIKE', "%{$search}%");
                })->orWhereHas('project', function ($query) use ($search) {
                    $query->where('servings', 'LIKE', "%{$search}%");
                });
        });

        $mprs = $query->paginate(10)->withQueryString();

        $mprs->load('project');

        // dd($mprs);

        return Inertia::render('Mprs/Index', [
            'mprs' => $mprs,
            'filters' => request()->only('search'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $projects = Project::all();
        // $projects->append('full_project_name');
        // dd($projects);

        // $search = $request->input('search');
        // $projects = Project::when($search, function ($query) use ($search) {
        //     $query->where('name', 'like', '%' . $search . '%');
        // })->get();

        $query = Project::query();

        $query->when(request('search'), function ($q, $search) {
            $q->where('name', 'like', "%{$search}%");
        });

        // dd($query);

        $projects = $query->get();

        // dd($projects);


        return Inertia::render('Mprs/Create', [
            'projects' => $projects,
            'filters' => request()->only('search'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMprRequest $request)
    {

        foreach ($request->items as $item) {
            $mpr = Mpr::where('project_id', $item['project_id'])->orderBy('version_nbr', 'desc')->first();
            $project = Project::find($item['project_id']);
            if ($mpr) {
                // Create new Mpr with incremented version number                
                $item['version_nbr'] = $mpr->version_nbr + 1;
                Mpr::create($item);
            } else {
                // Create new Mpr
                $item['version_nbr'] = 1;
                Mpr::create($item);
            }
        }

        // dd($mpr);

        return redirect()->route('mprs.index')->with('success', 'Mpr(s) created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mpr $mpr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mpr $mpr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMprRequest $request, Mpr $mpr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mpr $mpr)
    {
        //
    }
}
