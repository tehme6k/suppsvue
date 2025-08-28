<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Mpr extends Model
{
    /** @use HasFactory<\Database\Factories\MprFactory> */
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'project_id',
        'version_nbr',
        'can_edit',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['project.name', 'version_nbr']) // Log changes to the 'roles' relationship
            ->logOnlyDirty() // Only log changed attributes
            ->dontSubmitEmptyLogs(); // Prevent logging if no changes occurred
    }

    public static function createMany(array $records)
    {
        foreach ($records as $record) {
            static::create($record); // or self::create($record);
        }
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
