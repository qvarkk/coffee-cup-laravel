<?php

namespace App\Http\Requests\Admin\Review;

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
            'title' => ['string', 'max:255'],
            'content' => ['string', 'max:2048'],
            'rating' => ['integer', 'between:1,5'],
        ];
    }

    public function messages()
    {
        return [
            'title.string' => 'Название должно быть строкой',
            'title.max' => 'Название не может быть длиннее 255 символов',
            'content.string' => 'Описание должно быть строкой',
            'content.max' => 'Описание не может быть длиннее 2048 символов',
            'rating.integer' => 'Рейтинг должен быть числом',
            'rating.between' => 'Рейтинг должен быть в пределах от 1 до 5',
        ];
    }
}
