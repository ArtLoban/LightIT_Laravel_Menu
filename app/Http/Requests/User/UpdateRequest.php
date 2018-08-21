<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
        $rules =[
            'name' => 'required|string|max:255',
            'email' => 'required|unique:users|string|email|max:255',
            'password' => 'nullable|string|min:6',
            'role_id' => 'required|digits:1',
            'image' => 'nullable|image|mimes:jpeg,jpg,bmp,png|max:1024'

        ];

        if ($this->updatedUserId) {
            $rules['email'] = sprintf('required|unique:users,email,%s|string|email|max:255', $this->updatedUserId);
        }

        return $rules;
    }
}
