<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExecutorController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/executors')->group(static function() {
    Route::get('/', [ExecutorController::class, 'index'])->name('executor.index');
    Route::post('/', [ExecutorController::class, 'store'])->name('executor.store');
    Route::patch('/{executor}', [ExecutorController::class, 'update'])->name('executor.update');
    Route::delete('/{executor}', [ExecutorController::class, 'delete'])->name('executor.delete');
});
