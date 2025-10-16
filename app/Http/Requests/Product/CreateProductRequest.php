<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    public function authorize(): bool {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:5', 'max:80'],
            'description' => ['required', 'string', 'min:5'],
            'price' => ['required', 'integer', 'min:1'],
            'status' => ['required', 'integer'],
        ];
    }
}
