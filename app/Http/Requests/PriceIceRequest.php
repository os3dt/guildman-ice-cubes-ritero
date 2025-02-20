<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PriceIceRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'db_item_id' => ['required'],
            'one' => ['required'],
            'stack' => ['required'],
            'shulker' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
