<?php

namespace App\Classes\Abstracts;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractStoreService
{

    public $id;

    public $model;

    public $dataTransferObject;

    /**
     * @return Model
     */
    abstract protected function model() : Model;

    /**
     * @return AbstractDataTransferObject
     */
    abstract protected function dataTransferObject() : AbstractDataTransferObject;

    /**
     * @param $dataTransferObject
     * @param AbstractRequestValidation $abstractRequestValidation
     * @return Model
     */
    public function execute($dataTransferObject, AbstractRequestValidation $abstractRequestValidation = null): Model
    {
        return $this->_setDataTransferObject($dataTransferObject, $abstractRequestValidation)
                ->_setModel($this->dataTransferObject->id)
                ->_updateOrCreate($this->dataTransferObject)
                ->_setModel($this->id)
                ->_getModel();
    }

    /**
     * @param $data
     * @return AbstractStoreService
     */
    private function _setDataTransferObject($dataTransferObject, AbstractRequestValidation $abstractRequestValidation = null)
    {
        $this->dataTransferObject = !($dataTransferObject instanceof AbstractDataTransferObject) ? $this->dataTransferObject()->setRequestDatas($dataTransferObject)->makeValidation($abstractRequestValidation) : $dataTransferObject;

        return $this;
    }

    /**
     * @param int $id
     * @return AbstractStoreService
     */
    private function _setModel(int $id = null)
    {
        if($id){
            $this->model = $this->model()->find($id);
        }else{
            $this->model = null;
        }

        return $this;
    }

    /**
     * @return Model
     */
    private function _getModel(): Model{
        return $this->model;
    }

    /**
     * @return AbstractStoreService
     */
    private function _setId()
    {
        $this->id = $this->model->id;
        
        return $this;
    }

    /**
     * @param AbstractDataTransferObject $abstractDataTransferObject
     * @return AbstractStoreService
     */
    private function _updateOrCreate(AbstractDataTransferObject $abstractDataTransferObject)
    {
        if($this->model){
            $this->model->update($abstractDataTransferObject->toArray());
        } else {
            $this->model = $this->model()->create($abstractDataTransferObject->toArray());
        }

        $this->_setId();
        
        return $this;
    }
}