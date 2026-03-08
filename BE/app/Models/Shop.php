<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shop extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'name',
        'slug',
        'subdomain',
        'latitude',
        'longitude',
        'city',
        'theme_settings',
    ];

    protected $casts = [
        'theme_settings' => 'array',
    ];

    public function barbers(): HasMany {
        return $this->hasMany(User::class, 'shop_id');
    }


    public function services(): HasMany {
        return $this->hasMany(Service::class);
    }
}
