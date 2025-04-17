<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Password;

class PasswordUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'old_password' => 'current_password',
            // 'new_password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()->symbols()]
            'new_password' => [
                'required',
                'confirmed',
                'min:8', // Minimum length of password
                'regex:/[a-z]/', // At least one letter
                'regex:/[0-9]/', // At least one number
                'regex:/[@$!%*?&]/', // At least one symbol
            ]
        ];
    }
}
