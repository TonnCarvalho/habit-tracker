<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:60|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Campo é obrigatório.',
            'name.string' => 'Campo só pode ser so tipo texto.',
            'name.max' => 'Nome teve ter no maximo :max caracteres.',

            'email.required' => 'Campo é obrigatório.',
            'email.email' => 'Informe um email valido.',
            'email.unique' => 'Email já em uso.',

            'password.required' => 'Campo é obrigatório.',
            'password.min' => 'Senha teve ter no minimo :min caracteres.',
            'password.max' => 'Senha teve ter no maximo :max caracteres.',
            'password.confirmed' => 'Senha não são iguais.',
        ];
    }
}
