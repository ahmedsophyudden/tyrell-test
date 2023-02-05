<?php

namespace App\Classes\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

trait LogTrait
{
    protected function logModule(array $logModule, Model $model, ?Collection $sub_models = null, ?string $relationship = 'logModules')
    {
        app('App\Services\Modules\CORE\Logs\Processors\LogModuleValidationAndStoreProcessor')->execute($logModule, $model, $relationship);

        if ($sub_models) {
            foreach ($sub_models as $index => $sub_model) {
                app('App\Services\Modules\CORE\Logs\Processors\LogModuleValidationAndStoreProcessor')->execute($logModule, $sub_model, $relationship);
            }
        }
    }
}