<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentInvoice extends Model
{
    protected $fillable = [
        'user_id', 'document_id','document_template_id','legalization_id', 'type','document_price','legalization_price','transaction_uuid','price_matrix_id','amount','transaction_id'
    ];
}
