<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;

    protected $guarded = [];

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
