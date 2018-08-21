<?php

namespace App\Http\Requests\Dish;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
//        return Auth::getUser();
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
            'name' => 'required|string|unique:dishes|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|digits:100',
            'ingredient_id' => 'required|digits:100',
            'price' => 'nullable|numeric|max:9',
            'weight' => 'nullable|numeric|integer|max:9',
            'image' => 'nullable|image|mimes:jpeg,jpg,bmp,png|max:1024',
        ];
    }
}
