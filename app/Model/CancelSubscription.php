<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CancelSubscription extends Model
{
    protected $fillable = [
        'purchase_id', 'credit_amount','user_id','is_active',
    ];
}
