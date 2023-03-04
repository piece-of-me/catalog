<?php

namespace App\Http\Requests\Song;

use App\Rules\UniqueSong;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'orderNumberInAlbum' => 'numeric',
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
