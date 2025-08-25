<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $guarded = [];

    public static function createMany(array $records)
    {
        foreach ($records as $record) {
            static::create($record); // or self::create($record);
        }
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
