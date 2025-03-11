<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TypeRequest extends FormRequest
{
    public function rules():array {
        return [
            'id' => 'sometimes|string',
            'name' => 'required|string'
        ];
    }

    public function messages():array{
        return [
            'name.required' => 'El nombre del tipo es obligatorio.'
        ];
    }
}
