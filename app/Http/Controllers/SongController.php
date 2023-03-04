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
    public function index(): JsonResponse
    {
        $songs = Song::all();
        return Response::json(['data' => SongResource::collection($songs)]);
    }

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

    public function delete(Song $song): JsonResponse
    {
        $song->delete();
        return Response::json(['success' => true]);
    }
}
