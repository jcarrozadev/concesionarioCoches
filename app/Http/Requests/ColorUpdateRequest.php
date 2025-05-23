<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ColorUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'id' => 'required|integer',
            'name' => 'sometimes|string',
            'hex' => 'sometimes|string'
        ];
    }
}
