<?php

namespace App\Models;

use App\Traits\OberserverTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory, OberserverTrait;

    protected $fillable = [
        'name', 'description'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'id'
    ];
}
