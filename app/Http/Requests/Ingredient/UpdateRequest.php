<?php

namespace App\Http\Requests\Ingredient;

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
            'name' => 'required|string|unique:ingredients|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,jpg,bmp,png|max:1024'
        ];

        if ($this->updatedIngredientId) {
            $rules['name'] = sprintf('required|string|unique:categories,name,%s|max:255', $this->updatedIngredientId);
        }

        return $rules;
    }
}
