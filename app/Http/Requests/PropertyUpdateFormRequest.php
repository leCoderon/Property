<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyUpdateFormRequest extends FormRequest
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
            'title' => ['required', 'min:8'],
            'description' => ['required', 'min:8'],
            'price' => ['required', 'integer', 'min:0'],
            'rooms' => ['required', 'integer', 'min:1'],
            'surface' => ['required', 'integer', 'min:2'],
            'bedrooms' => ['required', 'integer', 'min:0'],
            'bedrooms' => ['required', 'integer', 'min:0'],
            'floor' => ['required', 'integer', 'min:0'],
            'city' => ['required'],
            'postal_code' => ['required', 'min:3'],
            'address' => ['required', 'min:10'],
            'sold' => ['required', 'boolean'],
            'options' => ['required', 'array', 'exists:options,id'],
            'images' => ['nullable'],
            'images.*' => ['nullable', 'image', 'mimes:png,jpg,svg,gif,jpeg, webp', 'max:2048'],
        ];
    }
}
