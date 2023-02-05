<?php

namespace App\Classes\Abstracts;

use Illuminate\Database\Eloquent\Model;
use App\Classes\Abstracts\AbstractDataTransferObject;

abstract class AbstractStoreRelationService
{
    public $id;

    public $model;

    public $parentModel;

    public $relation;

    /**
     * @return Model
     */
    abstract protected function model() : Model;

    /**
     * @return Model
     */
    public function execute(AbstractDataTransferObject $abstractDataTransferObject, Model $parentModel, string $relation): Model
    {
        $this->relation = $relation;

        return $this->_setParentModel($parentModel)
                ->_setModel($abstractDataTransferObject->id)
                ->_updateOrCreate($abstractDataTransferObject)
                ->_setModel($this->id)
                ->_getModel();
    }

    /**
     * @param Model $parentModel
     * @return AbstractStoreRelationService
     */
    private function _setParentModel(Model $parentModel)
    {
        $this->parentModel = $parentModel;

        return $this;
    }

    /**
     * @return Model
     */
    private function _getParentModel(): Model{
        return $this->parentModel;
    }


    /**
     * @param int $id
     * @return AbstractStoreRelationService
     */
    private function _setModel(int $id = null){
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
     * @return AbstractStoreRelationService
     */
    private function _setId()
    {
        $this->id = $this->model->id;
        
        return $this;
    }

    /**
     * @param AbstractDataTransferObject $abstractDataTransferObject
     * @return AbstractStoreRelationService
     */
    private function _updateOrCreate(AbstractDataTransferObject $abstractDataTransferObject)
    {
        if($this->model){
            $this->model->update($abstractDataTransferObject->toArray());
        }else{
            $this->model = $this->parentModel->{$this->relation}()->save($abstractDataTransferObject->toModel());
        }
        $this->_setId();
        
        return $this;
    }
}