<?php

namespace App\Classes\Abstracts;

use DB;
use Illuminate\Http\Request;
use App\Services\Generals\Traits\LogTrait;
use App\Services\Generals\Traits\NotifyTrait;
use App\Services\Generals\Traits\DocumentTrait;

abstract class AbstractLogic
{
    use LogTrait, NotifyTrait, DocumentTrait;

    /**
     * @param Request request
     * @return Response
     * @throws ErrorException
     */
    abstract protected function logic(Request $request);

    /**
     * @param Request $request
     * @return Response
     * @throws ErrorException
     */
    public function execute(Request $request)
    {

        try {

            DB::beginTransaction();

            $response = $this->logic($request);

            DB::commit();

            return $response;
        } catch (Exception $exception) {

            return $exception;
        }
    }
}
