<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:26',
            'username' => 'required|string|max:30|unique:users,username,' . Auth::user()->id,
            'bio'=> 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return[
            'name.required' => 'El nombre es obligatorio.',
            'name.max' => 'El nombre no debe exceder los 26 caracteres.',
            'username.required' => 'El nombre de usuario es obligatorio.',
            'username.max' => 'El nombre de usuario no debe exceder los 30 caracteres.',
            'username.unique' => 'El nombre de usuario ya está en uso.',
            'bio.max' => 'La biografía no debe exceder los 255 caracteres.',
        ];
    }
    protected function prepareForValidation()
    {
        $user = auth()->user();
        $this->merge([
            
        ]); 
    }
}
