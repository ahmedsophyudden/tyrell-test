<?php

namespace App\Services\Users\Services;

use ErrorException;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class UserDelete
{

    public function execute(int $id)
    {
        try {
            // throw new ErrorException('Failed to delete', 419);
            DB::beginTransaction();

            $user = User::find($id);
            $user->delete();
            
            DB::commit();

            return [];
        } catch (\Exception $exception){
            throw new ErrorException($exception->getMessage(), $exception->getCode());
        }
    }

}
