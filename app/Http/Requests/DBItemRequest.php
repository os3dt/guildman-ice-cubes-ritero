<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DBItemRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:1' ,'max:255'],
            'icon' => ['required', 'url', 'string'],
            'stack' => ['required', 'integer', 'min:0'],
        ];
    }

    public function authorize(): true
    {
        return true;
    }
}
