<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;
    use LogsActivity;

    protected $guarded = [];

    //     protected static function booted()
    // {
    //     static::deleting(function ($project) {
    //         if ($project->mprs()->exists()) {
    //             // Optionally, add an error message to the session
    //             session()->flash('error', 'Cannot delete project as it has associated mprs.');
    //             return false; // Prevent deletion
    //         }
    //     });
    // }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'descriptor', 'servings']) // Log changes to project name, descriptor and/or servings
            ->logOnlyDirty() // Only log changed attributes
            ->dontSubmitEmptyLogs(); // Prevent logging if no changes occurred
    }

    public static function createMany(array $records)
    {
        foreach ($records as $record) {
            static::create($record); // or self::create($record);
        }
    }

    public function mprs(): HasMany
    {
        return $this->hasMany(Mpr::class);
    }

    public function getFullProjectNameAttribute()
    {
        return "{$this->name} - {$this->descriptor} ({$this->servings}) servings";
    }

    protected $appends = ['full_project_name'];
}
