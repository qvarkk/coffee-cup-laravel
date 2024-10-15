<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'name' => ['string', 'max:255'],
            'email' => ['string', 'email', 'max:255', 'unique:users,email,'.$this->user_id],
            'password' => ['string', 'min:8', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'name.string' => 'Название должно быть строкой',
            'name.max' => 'Название не может превышать допустимое количество символов',
            'email.string' => 'Почта должна быть строкой',
            'email.max' => 'Почта не может превышать допустимое количество символов',
            'email.email' => 'Почта должна быть действительным адресом электронной почты',
            'email.unique' => 'Эта почта уже зарегистрирована',
            'user_id.required' => 'Необходимо добавить скрытое поле user_id',
            'role.integer' => 'Роль должна быть целым числом',
        ];
    }
}
