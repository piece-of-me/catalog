<?php

namespace App\Http\Requests\Album;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * @OA\Schema(
 *     schema="AlbumUpdateRequest",
 *     description="Данные запроса для обновления данных альбома",
 *     @OA\Property (property="name", type="string", example="We Are Not Your Kind", description="Название аольбома"),
 *     @OA\Property (property="year", type="int", example="2019", description="Год выпуска"),
 *     @OA\Property (property="executorId", type="int", example="2", description="Id исполнителя ольбома"),
 * )
 */
class UpdateRequest extends FormRequest
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
            'name' => 'string',
            'year' => ['numeric', 'between:1950,' . $this->_curYear],
            'executorId' => 'numeric|exists:executors,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => 'Поле "name" должно быть строкой',
            'year.numeric' => 'Поле "year" должно быть числом',
            'year.between' => 'Поле "year" должно быть годом между 1950 и ' . $this->_curYear,
            'executorId.numeric' => 'Поле "executorId" должно быть числом',
            'executorId.exists' => 'Не найдено исполнителя с переданным индексом'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
