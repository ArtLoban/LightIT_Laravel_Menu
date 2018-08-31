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
            'category_id' => 'required|integer',
            'ingredient_id' => 'array',
            'ingredient_id.*' => 'integer',
            'price' => 'nullable|numeric|between:0,99999999.9',
            'weight' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpeg,jpg,bmp,png|max:1024',
        ];
    }
}