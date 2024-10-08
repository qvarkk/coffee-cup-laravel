<?php

namespace App\Http\Requests\Admin\Product;

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
            'name' => ['string', 'max:255'],
            'description' => ['string', 'max:2048'],
            'image' => ['url'],
            'category_id' => ['integer', 'exists:categories,id'],
            'serving' => ['integer'],
            'in_stock' => ['integer', 'max:99999'],
            'price' => ['numeric'],
        ];
    }

    public function messages()
    {
        return [
            'name.string' => 'Название должно быть строкой',
            'name.max' => 'Название не может превышать допустимое количество символов (255)',
            'description.string' => 'Описание должно быть строкой',
            'description.max' => 'Описание не может превышать допустимое количество символов (2048)',
            'image.url' => 'Изображение должно содержать допустимый URL',
            'category_id.integer' => 'Категория должна быть целым числом',
            'category_id.exists' => 'Выбранная категория не существует',
            'serving.integer' => 'Граммовка должна быть целым числом',
            'in_stock.integer' => 'Наличие должно быть целым числом',
            'in_stock.max' => 'Наличие не может превышать допустимое количество',
            'price.numeric' => 'Цена должна быть числом'
        ];
    }
}
