<?php

namespace App\Http\Controllers;

use App\Http\Requests\Album\StoreRequest;
use App\Http\Requests\Album\UpdateRequest;
use App\Http\Resources\AlbumResource;
use App\Models\Album;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class AlbumController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/albums/",
     *      operationId="GetAlbums",
     *      tags={"Альбомы"},
     *      summary="Получение информации об альбомах",
     *      description="Получение массива всех альбомов",
     *      @Oa\Response(
     *          response=200,
     *          description="Успешный запрос",
     *          @OA\JsonContent(
     *               @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/AlbumResource"))
     *          )
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Ошибка при выполнении запроса",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Internal Server Error", description="Сообщение об ошибке"),
     *          )
     *      )
     * )
     */
    public function index(): JsonResponse
    {
        $albums = Album::all();
        return Response::json(['data' => AlbumResource::collection($albums)]);
    }

    /**
     * @OA\Post(
     *      path="/api/albums/",
     *      operationId="PostAlbum",
     *      tags={"Альбомы"},
     *      summary="Добавление альбома",
     *      description="Добавление альбома",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/AlbumStoreRequest")
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Успешный запрос",
     *          @OA\JsonContent(@OA\Property(property="data", type="object", ref="#/components/schemas/AlbumResource"))
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Ошибка валидации данных",
     *          @OA\JsonContent(
     *              @OA\Property(property="name", type="string", example="Поле 'name' должно быть строкой", description="Сообщение ошибки валидатора"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Ошибка при выполнении запроса",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Internal Server Error", description="Сообщение об ошибке"),
     *          )
     *      )
     * )
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        $album = Album::firstOrCreate([
            'executor_id' => $data['executorId'],
            'name' => $data['name'],
            'year_of_issue' => $data['year'],
        ]);
        return Response::json(['data' => new AlbumResource($album)]);
    }

    /**
     * @OA\Patch(
     *      path="/api/albums/{album_id}",
     *      operationId="PatchAlbum",
     *      tags={"Альбомы"},
     *      summary="Обновление информации об альбоме",
     *      description="Обновление информации об альбоме",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/AlbumUpdateRequest")
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Успешный запрос",
     *          @OA\JsonContent(@OA\Property(property="data", type="object", ref="#/components/schemas/AlbumResource"))
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Альбом не найден",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Entity Not Found", description="Сообщение об ошибке"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Ошибка валидации данных",
     *          @OA\JsonContent(
     *              @OA\Property(property="name", type="string", example="Поле 'name' должно быть строкой", description="Сообщение ошибки валидатора"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Ошибка при выполнении запроса",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Internal Server Error", description="Сообщение об ошибке"),
     *          )
     *      )
     * )
     */
    public function update(Album $album, UpdateRequest $request): JsonResponse
    {
        $data = $request->validated();
        $album->update([
            'executor_id' => $data['executorId'] ?? $album->executor_id,
            'name' => $data['name'] ?? $album->name,
            'year_of_issue' => $data['year'] ?? $album->year_of_issue,
        ]);
        return Response::json(['data' => new AlbumResource($album)]);
    }

    /**
     * @OA\Delete(
     *      path="/api/albums/{album_id}",
     *      operationId="DeletehAlbum",
     *      tags={"Альбомы"},
     *      summary="Удаление альбома",
     *      description="Удаление альбома и всей информации о нем",
     *      @Oa\Response(
     *          response=200,
     *          description="Успешный запрос",
     *          @OA\JsonContent(
     *              @OA\Property(property="success", type="boolean", example="true"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Альбом не найден",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Entity Not Found", description="Сообщение об ошибке"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Ошибка при выполнении запроса",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Internal Server Error", description="Сообщение об ошибке"),
     *          )
     *      )
     * )
     */
    public function delete(Album $album): JsonResponse
    {
        $album->delete();
        return Response::json(['success' => true]);
    }
}
