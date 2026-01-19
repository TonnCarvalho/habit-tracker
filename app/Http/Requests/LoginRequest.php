<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'required|email',
            'password' => 'required|min:6|max:60'
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Formato de email invalido',
            'password.required' => 'Preencha o campo',
            'password.min' => 'A senha tem que ter :min caracteres'
        ];
    }
}
