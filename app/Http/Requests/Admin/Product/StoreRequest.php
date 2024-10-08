<?php

namespace App\Http\Requests\Admin\Product;

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
            'description' => ['required', 'string', 'max:2048'],
            'image' => ['required', 'url'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'serving' => ['required', 'integer'],
            'in_stock' => ['required', 'integer', 'max:99999'],
            'price' => ['required', 'numeric'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Название обязательно для заполнения',
            'name.string' => 'Название должно быть строкой',
            'name.max' => 'Название не может превышать допустимое количество символов (255)',
            'description.required' => 'Описание обязательно для заполнения',
            'description.string' => 'Описание должно быть строкой',
            'description.max' => 'Описание не может превышать допустимое количество символов (2048)',
            'image.required' => 'Изображение обязательно для заполнения',
            'image.url' => 'Изображение должно содержать допустимый URL',
            'category_id.required' => 'Категория обязательна для заполнения',
            'category_id.integer' => 'Категория должна быть целым числом',
            'category_id.exists' => 'Выбранная категория не существует',
            'serving.required' => 'Граммовка обязательна для заполнения',
            'serving.integer' => 'Граммовка должна быть целым числом',
            'in_stock.required' => 'Наличие обязательно для заполнения',
            'in_stock.integer' => 'Наличие должно быть целым числом',
            'in_stock.max' => 'Наличие не может превышать допустимое количество',
            'price.required' => 'Цена обязательна для заполнения',
            'price.numeric' => 'Цена должна быть числом'
        ];
    }
}
