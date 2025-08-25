<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mpr extends Model
{
    /** @use HasFactory<\Database\Factories\MprFactory> */
    use HasFactory;

    protected $fillable = [
        'project_id',
        'version_nbr',
        'can_edit',
    ];

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
