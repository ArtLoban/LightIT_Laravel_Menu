<?php

namespace App\Http\Requests\Dish;

use Illuminate\Foundation\Http\FormRequest;

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
            'name' => 'required|string|unique:dishes|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|digits:100',
            'ingredient_id' => 'required|digits:100',
            'price' => 'nullable|numeric|max:9',
            'weight' => 'nullable|numeric|integer|max:9',
            'image' => 'nullable|image|mimes:jpeg,jpg,bmp,png|max:1024',
        ];

        if ($this->updatedDishId) {
            $rules['name'] = sprintf('required|unique:dishes,name,%s|string|max:255', $this->updatedDishId);
        }

        return $rules;
    }
}
