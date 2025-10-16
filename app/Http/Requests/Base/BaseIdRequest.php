<?php

namespace App\Http\Requests\Base;

use Illuminate\Foundation\Http\FormRequest;

class BaseIdRequest extends FormRequest
{
    protected string $table;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => ['required', 'integer', "exists:$this->table,id"],
        ];
    }

    public function validationData(): array
    {
        return array_merge($this->request->all(), [
            'id' => $this->route('id'),
        ]);
    }
}
