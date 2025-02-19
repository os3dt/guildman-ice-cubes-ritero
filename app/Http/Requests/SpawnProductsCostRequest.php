<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpawnProductsCostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'db_item_id' => ['required'],
            'one_item' => ['integer', 'string'],
            'one_stack' => ['integer', 'string'],
            'one_shulker' => ['integer', 'string'],
            'trader' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
