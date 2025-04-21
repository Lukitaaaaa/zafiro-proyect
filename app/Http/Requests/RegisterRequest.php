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
            'name' => 'required|string|max:26 ',
            'email' => 'required|email|unique:users',
            'username' => 'required|max:255|unique:users',
            'password' => 'required|min:8|confirmed',
            'slug' => '',
        ];
    }

    public function messages()
    {
        return[
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre no debe exceder los 26 caracteres.',
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'El email debe ser un correo electrónico válido.',
            'email.unique' => 'El email ya está en uso.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ];
    } 
    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => str($this->get('username'))->slug(),
        ]);
    }
}
