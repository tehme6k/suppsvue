<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    use LogsActivity;

    protected $guarded = [];

    // logging functions
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'description', 'category.name']) // Log changes to product name, description and/or category name
            ->logOnlyDirty() // Only log changed attributes
            ->dontSubmitEmptyLogs(); // Prevent logging if no changes occurred
    }


    // functions to use inside controller
    public static function createMany(array $records)
    {
        foreach ($records as $record) {
            static::create($record); // or self::create($record);
        }
    }

    // model relationships
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

        public function formulas(): HasMany
    {
        return $this->HasMany(Formula::class);
    }
}
