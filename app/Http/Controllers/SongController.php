<?php

namespace App\Http\Controllers;

use App\Http\Requests\Song\StoreRequest;
use App\Http\Requests\Song\UpdateRequest;
use App\Http\Resources\SongResource;
use App\Models\Song;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\JsonResponse;

class SongController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/songs/",
     *      operationId="GetSongs",
     *      tags={"Песни"},
     *      summary="Получение информации о песнях",
     *      description="Получение информации о песнях",
     *      @OA\Response(
     *          response=200,
     *          description="Успешный запрос",
     *          @OA\JsonContent(
     *               @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/SongResource"))
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
        $songs = Song::all();
        return Response::json(['data' => SongResource::collection($songs)]);
    }

    /**
     * @OA\Post(
     *      path="/api/songs/",
     *      operationId="PostSong",
     *      tags={"Песни"},
     *      summary="Добавление песни",
     *      description="Добавление песни",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/SongStoreRequest")
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Успешный запрос",
     *          @OA\JsonContent(@OA\Property(property="data", type="object", ref="#/components/schemas/SongResource"))
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
        $song = Song::firstOrCreate([
            'album_id' => $data['albumId'],
            'name' => $data['name'],
            'order_number_in_album' => $data['orderNumberInAlbum'],
        ]);
        return Response::json(['data' => new SongResource($song)]);
    }

    /**
     * @OA\Patch(
     *      path="/api/songs/{song_id}",
     *      operationId="PatchSong",
     *      tags={"Песни"},
     *      summary="Обновление информации о песне",
     *      description="Обновление информации о песне",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/SongUpdateRequest")
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Успешный запрос",
     *          @OA\JsonContent(@OA\Property(property="data", type="object", ref="#/components/schemas/SongResource"))
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Песня не найдена",
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
    public function update(Song $song, UpdateRequest $request): JsonResponse
    {
        $data = $request->validated();
        $song->update([
            'album_id' => $data['albumId'] ?? $song->album_id,
            'name' => $data['name'] ?? $song->name,
            'order_number_in_album' => $data['orderNumberInAlbum'] ?? $song->order_number_in_album,
        ]);
        return Response::json(['data' => new SongResource($song)]);
    }

    /**
     * @OA\Delete(
     *      path="/api/songs/{songs_id}",
     *      operationId="DeleteSong",
     *      tags={"Песни"},
     *      summary="Удаление песни",
     *      description="Удаление песни",
     *      @OA\Response(
     *          response=200,
     *          description="Успешный запрос",
     *          @OA\JsonContent(
     *              @OA\Property(property="success", type="boolean", example="true")
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Исполнитель не найден",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Entity Not Found", description="Сообщение об ошибке")
     *          )
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Ошибка при выполнении запроса",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Internal Server Error", description="Сообщение об ошибке")
     *          )
     *      )
     * )
     */
    public function delete(Song $song): JsonResponse
    {
        $song->delete();
        return Response::json(['success' => true]);
    }
}
