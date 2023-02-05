<?php

namespace App\Services\Auths\Requests;

use Illuminate\Support\Facades\Route;
use App\Classes\Abstracts\AbstractRequestValidation;

class LoginRequest extends AbstractRequestValidation
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
        ];

        $actions = Route::getCurrentRoute()->getActionName();
        $action = explode('@', $actions)[1];

        if($action != 'loginSocialite'){
            $rules['email'] = 'required';
            $rules['password'] = 'required|string|min:6';
        }

        return $rules;
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [];
    }
}
