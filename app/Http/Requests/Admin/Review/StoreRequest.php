<?php

namespace App\Http\Requests\Admin\Review;

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
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string', 'max:2048'],
            'rating' => ['required', 'integer', 'between:1,5'],
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'Пользователь обязателен для выбора',
            'user_id.integer' => 'Неверный формат пользователя',
            'user_id.exists' => 'Выбранный пользователь не существует',
            'product_id.required' => 'Продукт обязателен для выбора',
            'product_id.integer' => 'Неверный формат продукта',
            'product_id.exists' => 'Выбранный продукт не существует',
            'title.required' => 'Название обязательно для заполнения',
            'title.string' => 'Название должно быть строкой',
            'title.max' => 'Название не может быть длиннее 255 символов',
            'content.required' => 'Описание обязательно для заполнения',
            'content.string' => 'Описание должно быть строкой',
            'content.max' => 'Описание не может быть длиннее 2048 символов',
            'rating.required' => 'Рейтинг обязателен для заполнения',
            'rating.integer' => 'Рейтинг должен быть числом',
            'rating.between' => 'Рейтинг должен быть в пределах от 1 до 5',
        ];
    }
}
