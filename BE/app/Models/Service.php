<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'shop_id',
        'name',
        'duration_minutes',
        'price',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function shop(): BelongsTo {
        return $this->belongsTo(Shop::class);
    }

    public function scopeIncludeTrashed(Builder $query, $includeDeleted = false) {
        return $includeDeleted ? $query->withTrashed() : $query;
    }
}
