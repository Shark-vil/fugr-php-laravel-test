<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\NotebookController;

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

Route::prefix('v1/notebook')->group(function () {
	// GET /api/v1/notebook/
	Route::get('/', [NotebookController::class, 'index']);
	// GET /api/v1/notebook/<id>/
	Route::get('/{id}', [NotebookController::class, 'show']);
	// POST /api/v1/notebook/
	Route::post('/', [NotebookController::class, 'store']);
	// POST /api/v1/notebook/<id>/
	Route::post('/{id}', [NotebookController::class, 'update']);
	// DELETE /api/v1/notebook/<id>/
	Route::delete('/{id}', [NotebookController::class, 'destroy']);
});