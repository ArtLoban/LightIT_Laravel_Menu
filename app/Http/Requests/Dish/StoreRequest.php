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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'nullable',
            'price' => 'nullable',
            'weight' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,jpg,bmp,png|max:1024',
            'ingredient_id' => 'nullable',
        ];
    }
}
