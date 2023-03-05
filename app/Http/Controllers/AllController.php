<?php

namespace App\Http\Controllers;


use App\Http\Resources\All\ExecutorResource;
use App\Models\Executor;
use Illuminate\Support\Facades\Response;

class AllController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/all/",
     *      operationId="GetAllInfo",
     *      tags={"Общая информация"},
     *      summary="Получение всей информации",
     *      description="Получение всех данных",
     *      @OA\Response(
     *          response=200,
     *          description="Успешный запрос",
     *          @OA\JsonContent(
     *              @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/AllExecutorResource"))
     *          )
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Ошибка при выполнении запроса"
     *      ),
     * )
     */
    public function __invoke(): \Illuminate\Http\JsonResponse
    {
        return Response::json(['data' => ExecutorResource::collection(Executor::all())]);
    }
}
