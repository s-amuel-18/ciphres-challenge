<?php

namespace App\Http\Requests;

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
        // * Validar las cantidades
        return [
            "title" => ["required", "string", "max:100", "min:1"],
            "description" => ["nullable", "string", "max:500"],
            "cost" => ["required", "numeric"],
            "price" => ["required", "numeric"],
            "tax" => ["required", "numeric"],
            "image" => ["nullable", "image", "mimes:png"],
        ];
    }
}
