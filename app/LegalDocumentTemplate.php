<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LegalDocumentTemplate extends Model
{
    public function documentType()
    {
        return $this->belongsTo(\App\DocumentType::class, 'template_type', 'id');
    }
    public function category()
    {
        return $this->belongsTo(\App\Category::class, 'category_id', 'id')->withTrashed();
    }
    public function priceMatrix()
    {
        return $this->hasMany(\App\PriceMatrix::class, 'document_id', 'id');
    }
    public function label(){
        
        return $this->hasMany(\App\TemplateLabel::class, 'document_id', 'id');
    }
}
