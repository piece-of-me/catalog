<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExecutorController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\SongController;

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

Route::prefix('/albums')->group(static function () {
    Route::get('/', [AlbumController::class, 'index'])->name('album.index');
    Route::post('/', [AlbumController::class, 'store'])->name('album.store');
    Route::patch('/{album}', [AlbumController::class, 'update'])->name('album.update');
    Route::delete('/{album}', [AlbumController::class, 'delete'])->name('album.delete');
});

Route::prefix('/songs')->group(static function() {
    Route::get('/', [SongController::class, 'index'])->name('song.index');
    Route::post('/', [SongController::class, 'store'])->name('song.store');
    Route::patch('/{song}', [SongController::class, 'update'])->name('song.update');
    Route::delete('/{song}', [SongController::class, 'delete'])->name('song.delete');
});
