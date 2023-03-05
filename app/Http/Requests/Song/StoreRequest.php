<?php

namespace App\Http\Requests\Song;

use App\Rules\Song\UniqueSong;
use App\Rules\Song\UniqueOrderNumberRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * @OA\Schema(
 *     schema="SongStoreRequest",
 *     description="Данные запроса для добавления песни",
 *     required={"name", "orderNumberInAlbum", "albumId"},
 *     @OA\Property (property="name", type="string", example="I Am Hated", description="Название песни"),
 *     @OA\Property (property="orderNumberInAlbum", type="int", example="10", description="Порядковый номер в альбоме"),
 *     @OA\Property (property="albumId", type="int", example="2", description="Id альбома")
 * )
 */
class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'orderNumberInAlbum' => ['required', 'numeric', new UniqueOrderNumberRule],
            'albumId' => 'required|numeric|exists:albums,id',
            'name' => ['required', 'string', new UniqueSong],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Поле "name" обязательно',
            'name.string' => 'Поле "string" должно быть строкой',
            'orderNumberInAlbum.required' => 'Поле "orderNumberInAlbum" обязательно',
            'orderNumberInAlbum.numeric' => 'Поле "orderNumberInAlbum" должно быть числом',
            'albumId.required' => 'Поле "albumId" обязательно',
            'albumId.numeric' => 'Поле "albumId" должно быть числом',
            'albumId.exists' => 'Не найдено исполнителя с таким индексом',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
