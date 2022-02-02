<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            "email" => "required|email",
            "password" => "required|min:6|max:12"
            // "password" => "required|min:6|max:12|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/"
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Please, Enter your e-mail address.',
            'password.required' => 'Please, Enter your password.',
            'password.min' => 'Your password must be at least 6 characters.',
            'password.max' => 'Not allowed more then 12 characters.',
            'password.regex' => 'Password should have at least 1 lowercase and 1 uppercase and 1 number.'
        ];
    }
}
