<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Formula extends Model
{
    /** @use HasFactory<\Database\Factories\FormulaFactory> */
    use HasFactory;
    use LogsActivity;

    protected $fillable = ['mpr_id', 'product_id', 'product_qty'];

    // logging functions
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['mpr.project.name','mpr.version_nbr', 'product.name', 'product_qty']) // Log changes
            // ->logOnlyDirty() // Only log changed attributes
            ->dontSubmitEmptyLogs(); // Prevent logging if no changes occurred
    }

    // model relationship functions
    public function mpr(): BelongsTo
    {
        return $this->belongsTo(Mpr::class);
    }

    public function product(): BelongsTo
    {
        return $this->BelongsTo(Product::class);
    }
}
