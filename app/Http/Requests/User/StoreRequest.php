<?php

namespace App\Http\Requests\User;

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
            'password' => ['required', 'string', 'min:8', 'max:255', 'confirmed'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Имя обязательно для заполнения',
            'name.string' => 'Имя должно быть строкой',
            'name.max' => 'Имя не может превышать допустимое количество символов',
            'email.required' => 'Почта обязательна для заполнения',
            'email.string' => 'Почта должна быть строкой',
            'email.max' => 'Почта не может превышать допустимое количество символов',
            'email.email' => 'Почта должна быть действительным адресом электронной почты',
            'email.unique' => 'Эта почта уже зарегистрирована',
            'role.integer' => 'Роль должна быть целым числом',
            'password.required' => 'Пароль обязателен для заполнения',
            'password.string' => 'Пароль должен быть строкой',
            'password.min' => 'Длина пароля должны быть не меньше 8 символов',
            'password.max' => 'Длина пародля не должна превышать 255 символов',
            'password.confirmed' => 'Пароли не совпадают'
        ];
    }
}
