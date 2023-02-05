<?php

namespace App\Services\Auths\Requests;

use Hash;
use App\Classes\Abstracts\AbstractRequestValidation;

class ChangePasswordRequest extends AbstractRequestValidation
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
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
        ];

        $rules['current_password'] = [
            'required',
            function ($attribute, $value, $fail) {
                $user = $this->user();
                if (!Hash::check($this->current_password, $user->password)) {
                    $fail('Current password does not match!');
                }
            }
        ];

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
