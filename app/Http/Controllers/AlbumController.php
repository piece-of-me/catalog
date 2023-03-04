<?php

namespace App\Http\Controllers;

use App\Http\Requests\Album\StoreRequest;
use App\Http\Requests\Album\UpdateRequest;
use App\Http\Resources\AlbumResource;
use App\Http\Resources\ExecutorResource;
use App\Models\Album;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class AlbumController extends Controller
{
    public function index(): JsonResponse
    {
        $albums = Album::all();
        return Response::json(['data' => AlbumResource::collection($albums)]);
    }
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

    public function delete(Album $album): JsonResponse
    {
        $album->delete();
        return Response::json(['success' => true]);
    }
}
