<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;

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

Route::get('/ping', function (Request $r) {
    return ['pong'=>true];
});

Route::get('/notes', [NoteController::class, 'all']);
Route::get('/note/{id}', [NoteController::class, 'one']);

Route::post('/note', [NoteController::class, 'new']);

Route::put('/note/{id}', [NoteController::class, 'edit']);

Route::delete('/note/{id}', [NoteController::class, 'delete']);