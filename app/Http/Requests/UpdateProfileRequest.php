<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'first_name' => 'max:30',
            'last_name' => 'max:30',
            'profile_photo' => 'image|mimes:png|max:2048',
            'profile_background' => 'image|mimes:png|max:2048',
            'user_location' => 'max:100',
        ];
    }
}
