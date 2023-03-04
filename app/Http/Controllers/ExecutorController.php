<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExecutorRequest;
use App\Http\Resources\ExecutorResource;
use App\Models\Executor;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class ExecutorController extends Controller
{
    public function index(): JsonResponse
    {
        $executors = Executor::all();
        return Response::json(['data' => ExecutorResource::collection($executors)]);
    }

    public function store(ExecutorRequest $request): JsonResponse
    {
        $data = $request->validated();
        $executor = Executor::firstOrCreate($data);
        return Response::json(['data' => new ExecutorResource($executor)]);
    }

    public function update(Executor $executor, ExecutorRequest $request): JsonResponse
    {
        $data = $request->validated();
        $executor->update($data);
        return Response::json(['data' => new ExecutorResource($executor)]);
    }

    public function delete(Executor $executor): JsonResponse
    {
        $executor->delete();
        return Response::json(['success' => true]);
    }
}
