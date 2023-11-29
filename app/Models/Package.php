<?php

namespace App\Models;

use App\Traits\OberserverTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Package extends Model
{
    use HasFactory, OberserverTrait;

    protected $hidden = [
        'created_at',
        'updated_at',
        'id'
    ];

    protected $fillable = [
        'name',
        'price',
        'is_best_seller',
        'description',
        'subscribe_period'
    ];

    public function features(): HasMany
    {
        return $this->hasMany(PackageFeature::class, 'package_id');
    }
}
