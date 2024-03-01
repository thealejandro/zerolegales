<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'user_id', 'subscription_id','price_id','price','transaction_uuid','transaction_id','transaction_type','is_pay'
    ];
}
