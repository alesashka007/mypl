<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'firstname' => ['required', 'string', 'max:20'],
            'lastname' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email'],
            'balance' => ['required', 'decimal:2'],
            'admin' => ['required', 'boolean'],
        ];
    }
}
