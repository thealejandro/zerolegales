<?php

namespace App\Repository;


use App\TemplateLabel;
use Exception;


class TemplateLabelRepository
{

    public function all($document_id){
        try {
            $label = TemplateLabel::where('document_id',$document_id)->get();
            return  $label;
        } catch (Exception $e) {

        logger()->error($e);
        return false;
        }
    }
}
