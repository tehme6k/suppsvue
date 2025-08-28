<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;
    use LogsActivity;

    protected $guarded = [];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'description']) // Log changes to the 'roles' relationship
            ->logOnlyDirty() // Only log changed attributes
            ->dontSubmitEmptyLogs(); // Prevent logging if no changes occurred
    }

    public static function createMany(array $records)
    {
        foreach ($records as $record) {
            static::create($record); // or self::create($record);
        }
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
