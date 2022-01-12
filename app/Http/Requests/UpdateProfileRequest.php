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
            'first_name' => 'nullable|min:3|max:20',
            'last_name' => 'nullable|min:3|max:20',
            'profile_photo' => 'nullable|image',
            'profile_background' => 'nullable|image',
            'user_location' => 'nullable|min:3|max:20',

        ];
    }
}
