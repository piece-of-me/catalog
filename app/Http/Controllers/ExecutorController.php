<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExecutorRequest;
use App\Http\Resources\ExecutorResource;
use App\Models\Executor;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class ExecutorController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/executors/",
     *      operationId="GetExecutors",
     *      tags={"Исполнители"},
     *      summary="Получение информации об исполнителе",
     *      description="Получение массива всех исполнителей",
     *      @OA\Response(
     *          response=200,
     *          description="Успешный запрос",
     *          @OA\JsonContent(
     *               @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/ExecutorResource"))
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
        $executors = Executor::all();
        return Response::json(['data' => ExecutorResource::collection($executors)]);
    }

    /**
     * @OA\Post(
     *      path="/api/executors/",
     *      operationId="PostExecutor",
     *      tags={"Исполнители"},
     *      summary="Добавление исполнителя",
     *      description="Добавление исполнителя",
     *      @OA\RequestBody(
     *        @OA\JsonContent(ref="#/components/schemas/ExecutorRequest")
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Успешный запрос",
     *          @OA\JsonContent(@OA\Property(property="data", type="object", ref="#/components/schemas/ExecutorResource")))
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Ошибка валидации данных",
     *          @OA\JsonContent(
     *              @OA\Property(property="name", type="string", example="Поле 'name' должно быть строкой", description="Сообщение ошибки валидации")
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
    public function store(ExecutorRequest $request): JsonResponse
    {
        $data = $request->validated();
        $executor = Executor::firstOrCreate($data);
        return Response::json(['data' => new ExecutorResource($executor)]);
    }

    /**
     * @OA\Patch(
     *      path="/api/executors/{executor_id}",
     *      operationId="PatchExecutor",
     *      tags={"Исполнители"},
     *      summary="Обновление информации об исполнителе",
     *      description="Обновление информации об исполнителе",
     *      @OA\RequestBody(
     *        @OA\JsonContent(ref="#/components/schemas/ExecutorRequest")
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Успешный запрос",
     *          @OA\JsonContent(@OA\Property(property="data", type="object", ref="#/components/schemas/ExecutorResource")))
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Исполнитель не найден",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Entity Not Found", description="Сообщение об ошибке")
     *          )
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Ошибка валидации данных",
     *          @OA\JsonContent(
     *              @OA\Property(property="name", type="string", example="Поле 'name' должно быть строкой", description="Сообщение ошибки валидации")
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
    public function update(Executor $executor, ExecutorRequest $request): JsonResponse
    {
        $data = $request->validated();
        $executor->update($data);
        return Response::json(['data' => new ExecutorResource($executor)]);
    }

    /**
     * @OA\Delete(
     *      path="/api/executors/{executor_id}",
     *      operationId="DeletehExecutor",
     *      tags={"Исполнители"},
     *      summary="Удаление исполнителя",
     *      description="Удаление исполнителя и всей информации о нем",
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
    public function delete(Executor $executor): JsonResponse
    {
        $executor->delete();
        return Response::json(['success' => true]);
    }
}
