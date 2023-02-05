<?php

namespace App\Classes\Traits;

use App\Services\Classes\Abstracts\AbstractRequestValidation;

trait TraitRequestValidation
{
    /**
     * @param AbstractRequestValidation $abstractRequestValidation
     * @param Array $data
     */
    private function mergeMakeValidation(AbstractRequestValidation $abstractRequestValidation = null, Array $data)
    {
        if($abstractRequestValidation){
            $abstractRequestValidation->merge($data)->makeValidation();
        }
    }
}
