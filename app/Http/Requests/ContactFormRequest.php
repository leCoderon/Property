<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
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
            'name'=>['required', 'string', 'min:2'],
            'surname'=>['required', 'string', 'min:2'],
            'phone'=>['required', 'string', 'min:1'],
            'email'=>['required', 'string', 'min:4'],
            'message'=>['required', 'string', 'min:2'],
        ];
    }
}
