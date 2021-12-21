<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Validation extends FormRequest
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
            'first_name' => 'sometimes|required|string',
            'last_name' => 'sometimes|required|string',
            'user_name' => 'sometimes|required|string|unique:users',
            'email' => 'sometimes|required|email|unique:users,email',
            'password' => 'min:6|required_with:password_confirmation',
            'password_confirmation' => 'same:password',
            'login' => 'sometimes|required|string',
            'text' => 'sometimes|required|min:10|max:255'
        ];
    }
}
