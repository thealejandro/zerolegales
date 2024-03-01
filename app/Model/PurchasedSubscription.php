<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PurchasedSubscription extends Model
{
    protected $fillable = [
        'user_id', 'subscription_id','price_matrice_id', 'grade_status','grade_date','is_active',
    ];

    public function priceMatrice(){
    	return $this->hasOne('App\PriceMatrix','id','price_matrice_id');
    }
    public function subscriptionType(){
    	return $this->hasOne('App\SubscriptionType','id','subscription_id');
    }
}
