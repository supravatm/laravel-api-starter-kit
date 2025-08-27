<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'unit' => 'required|numeric|min:0',
            'mrp' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0'
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => ':attribute field is mandatory',
            'description.required' => ':attribute field is mandatory',
            'unit.required' => ':attribute field is mandatory',
            'mrp.required' => ':attribute field is mandatory',
            'price.required' => ':attribute field is mandatory',
        ];
    }
}
