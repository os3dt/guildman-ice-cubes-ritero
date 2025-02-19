<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpawnProductsCostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'db_item_id' => ['required'],
            'one_stack' => ['integer'],
            'one_shulker' => ['integer'],
            'trader' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
