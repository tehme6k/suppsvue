<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;

    protected $guarded = [];

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
