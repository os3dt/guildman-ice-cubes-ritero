<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlayerRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'server_id' => ['required'],
            'discord_id' => ['required'],
            'balance' => ['integer', 'nullable'],
        ];
    }

    public function authorize(): true
    {
        return true;
    }
}
