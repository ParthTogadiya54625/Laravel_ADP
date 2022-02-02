<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdate extends FormRequest
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
        return [
            "first_name" => "required",
            "last_name" => "required",
            // "company" => "required",
            "email" => "required|email",
            "password" => "nullable|min:6|confirmed|max:12",
            "phone" => "required",
            "address" => "required",
            "city" => "required",
            "state" => "required",
            "zipcode" => "required",
            // "url" => "url|nullable",
        ];
    }
}
