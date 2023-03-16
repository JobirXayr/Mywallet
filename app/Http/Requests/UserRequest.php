<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'image' => 'max:2028|mimes:jpeg,png,jpg',
            'password' => 'min:8|max:30|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'min:8|max:30'
        ];
    }
}
