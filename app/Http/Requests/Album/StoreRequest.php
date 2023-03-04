<?php

namespace App\Http\Requests\Album;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreRequest extends FormRequest
{
    private string $_curYear;

    public function __construct(array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
        $this->_curYear = (new \DateTime('now'))->format('Y');
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'year' => ['required', 'numeric', 'between:1950,' . $this->_curYear],
            'executorId' => 'required|numeric|exists:executors,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Поле "name" обязательно',
            'name.string' => 'Поле "name" должно быть строкой',
            'year.required' => 'Поле "year" обязательно',
            'year.numeric' => 'Поле "year" должно быть числом',
            'year.between' => 'Поле "year" должно быть годом между 1950 и ' . $this->_curYear,
            'executorId.required' => 'Поле "executorId" обязательно',
            'executorId.numeric' => 'Поле "executorId" должно быть числом',
            'executorId.exists' => 'Не найдено исполнителя с переданным индексом'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
