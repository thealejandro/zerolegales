<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InputVariable extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    public function variableType(){

        return $this->belongsTo(\App\InputVariableType::class, 'variable_type', 'id');  
    }
}
