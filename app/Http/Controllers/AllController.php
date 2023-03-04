<?php

namespace App\Http\Controllers;


use App\Http\Resources\All\ExecutorResource;
use App\Models\Executor;
use Illuminate\Support\Facades\Response;

class AllController extends Controller
{
    public function __invoke(): \Illuminate\Http\JsonResponse
    {
        return Response::json(['data' => ExecutorResource::collection(Executor::all())]);
    }
}
