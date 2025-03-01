<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BalanceHistoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users'],
            'amount' => ['required', 'integer'],
            'type' => ['required'],
            'description' => ['required'],
        ];
    }

    public function authorize(): true
    {
        return true;
    }
}
