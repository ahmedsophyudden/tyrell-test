<?php

namespace App\Services\Users\Requests;

use App\Classes\Abstracts\AbstractRequestValidation;

class UserStoreRequest extends AbstractRequestValidation
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
            'name' => 'required',
            'email' => 'required|email',
        ];

        if (in_array($this->method(), ['POST'])) {
            $rules['password'] = 'required';
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
