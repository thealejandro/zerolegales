<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PriceMatrix extends Model
{
    use SoftDeletes;

    public function subscription()
    {
        return $this->belongsTo(\App\SubscriptionType::class, 'subscription_id', 'id');
    }

    public function document()
    {
        return $this->belongsTo(\App\LegalDocumentTemplate::class, 'document_id', 'id');
    }

    public function documentPurchase()
    {
        return $this->belongsTo(\App\DocumentInvoice::class, 'document_id', 'document_id')->where('document_invoices.is_pay',1);
    }

    public function purchase()
    {
        return $this->belongsTo(\App\Model\PurchasedSubscription::class, 'id', 'price_matrice_id');
    }
}
