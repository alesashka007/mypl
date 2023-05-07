<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RateUpdateRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:100'],
            'min_s' => ['required', 'int'],
            'max_s' => ['required', 'int'],
            'price' => ['required', 'decimal:2'],
            'quota' => ['required', 'int'],
            'tick' => ['int'],
            'vds_id' => ['required', 'int', 'exists:vds,id'],
            'game_id' => ['required', 'int', 'exists:games,id'],
            'addons' => ['required', 'boolean'],
            'ftp' => ['required', 'boolean'],
            'fastdl' => ['required', 'boolean'],
            'tv' => ['required', 'boolean'],
            'status' => ['required', 'boolean'],
        ];
    }
}
