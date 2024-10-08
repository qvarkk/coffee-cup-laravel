<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['integer']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Название обязательно для заполнения',
            'name.string' => 'Название должно быть строкой',
            'name.max' => 'Название не может превышать допустимое количество символов',
            'email.required' => 'Почта обязательна для заполнения',
            'email.string' => 'Почта должна быть строкой',
            'email.max' => 'Почта не может превышать допустимое количество символов',
            'email.email' => 'Почта должна быть действительным адресом электронной почты',
            'email.unique' => 'Эта почта уже зарегистрирована',
            'role.integer' => 'Роль должна быть целым числом',
        ];
    }
}
