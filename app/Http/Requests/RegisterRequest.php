<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    public $validator = null;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => [
                'required',
                'string',
                (
                    Password::min(8) // min 8 characters
                    ->mixedCase() // must be at least 1 upper case and 1 lower case
                    ->numbers() // must be at least 1 number
                    ->symbols() // must be at least 1 symbols
                    // ->uncompromised() // check if the password is common
                ),
                'confirmed'
            ],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $this->validator = $validator;
    }
}
