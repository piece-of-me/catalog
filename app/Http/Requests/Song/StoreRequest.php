<?php

namespace App\Http\Requests\Song;

use App\Rules\UniqueSong;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'orderNumberInAlbum' => 'required|numeric',
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
