<?php

namespace App\Models;

use App\Traits\OberserverTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory, OberserverTrait;

    const SAVING_TYPE = 1;
    const EXPENSE_TYPE = 2;

    protected $hidden = [
        'created_at',
        'updated_at',
        'id'
    ];

    protected $fillable = [
        'user_id',
        'saldo',
        'name',
        'wallet_category_id',
        'is_have_target',
        'target_amount',
        'target_timeline',
        'base_color'
    ];
}
