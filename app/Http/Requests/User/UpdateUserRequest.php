<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool {
        return auth()->check() && auth()->id() === (int) $this->route('id');
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:5'],
            'email' => [
                'required',
                'email',
                'unique:users,email,' . $this->route('id')
            ],
            'password' => ['required', 'min:8'],
            'photo' => 'nullable|image|max:2048'
        ];
    }
}
