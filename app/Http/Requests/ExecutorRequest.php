<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * @OA\Schema(
 *     schema="ExecutorRequest",
 *     description="Данные запроса для добавления исполнителя",
 *     required={"name"},
 *     @OA\Property (property="name", type="string", example="Yegor Letov", description="Название исполнителя")
 * )
 */
class ExecutorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Поле "name" обязательно',
            'name.string' => 'Поле "name" должно быть строкой',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
