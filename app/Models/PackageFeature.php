<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PackageFeature extends Model
{
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at',
        'id'
    ];

    protected $fillable = ['package_id', 'feature_id'];

    public function feature(): BelongsTo
    {
        return $this->belongsTo(Feature::class, 'feature_id');
    }
}
