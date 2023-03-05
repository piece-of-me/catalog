<?php

namespace App\Http\Requests\Song;

use App\Rules\Song\UniqueOrderNumberRule;
use App\Rules\Song\UniqueSong;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * @OA\Schema(
 *     schema="SongUpdateRequest",
 *     description="Данные запроса для обновления данных альбома",
 *     @OA\Property (property="name", type="string", example="Снаружи всех измерени", description="Название песни"),
 *     @OA\Property (property="orderNumberInAlbum", type="int", example="2", description="Порядковый номер в альбоме"),
 *     @OA\Property (property="albumId", type="int", example="16", description="Id альбома")
 * )
 */
class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'orderNumberInAlbum' => ['numeric', new UniqueOrderNumberRule($this->route()->song)],
            'albumId' => 'numeric|exists:albums,id',
            'name' => ['string', new UniqueSong($this->route()->song)],
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => 'Поле "string" должно быть строкой',
            'orderNumberInAlbum.numeric' => 'Поле "orderNumberInAlbum" должно быть числом',
            'albumId.numeric' => 'Поле "albumId" должно быть числом',
            'albumId.exists' => 'Не найдено исполнителя с таким индексом',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
