<?php

namespace App\Models;

use App\Traits\OberserverTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletCategory extends Model
{
    use HasFactory, OberserverTrait;

    protected $hidden = [
        'created_at',
        'updated_at',
        'id'
    ];

    protected $fillable = [
        'name',
        'description',
        'is_autosave',
        'is_term_condition',
        'is_lock',
        'account_number'
    ];
}
