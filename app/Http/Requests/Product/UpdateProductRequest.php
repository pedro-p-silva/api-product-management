<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['string', 'min:5', 'max:80'],
            'description' => ['string', 'min:5'],
            'price' => ['integer', 'min:1'],
            'status' => ['integer'],
        ];
    }
}
