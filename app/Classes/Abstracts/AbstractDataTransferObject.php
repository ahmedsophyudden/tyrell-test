<?php

namespace App\Classes\Abstracts;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Classes\Traits\TraitRequestValidation;

abstract class AbstractDataTransferObject
{
    use TraitRequestValidation;

    public $requestDatas;

    /**
     * @return Model
     */
    abstract protected function model(): Model;

    /**
     * @param $request
     * @param AbstractRequestValidation $abstractRequestValidation
     */
    public function __construct($request, AbstractRequestValidation $abstractRequestValidation = null)
    {
        $this->setRequestDatas($request)->makeValidation($abstractRequestValidation);
    }

    /**
     * param $request
     * @return AbstractDataTransferObject
     */
    public function setRequestDatas($request){
        $this->requestDatas = is_array($request) ? new Request($request) : $request;

        foreach ($this as $key => $value) {
            if (isset($this->requestDatas->{$key})) {
                $this->{$key} = $this->requestDatas->{$key};
            }
        }

        return $this;
    }

    /**
     * param $request
     * @return AbstractDataTransferObject
     */
    public function makeValidation(AbstractRequestValidation $abstractRequestValidation = null){
        $this->mergeMakeValidation($abstractRequestValidation, $this->toArray());

        return $this;
    }

    /**
     * @return Array
     */
    public function toArray(): array
    {
        $array = [];
        foreach ($this as $key => $value) {
            if ($value === NULL) {
                if($this->requestDatas->exists($key)){
                    $array[$key] = $value;
                }
            }else{
                $array[$key] = $value;
            }
        }

        return $array;
    }


    /**
     * @return Model
     */
    public function toModel(): Model
    {
        $model = $this->model();
        return $model->fill($this->toArray());
    }
}
