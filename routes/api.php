<?php

use App\Actions\Model\LogActions;
use App\Http\Controllers\LogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function() {
    Route::controller(LogController::class)->group(function() {
        Route::get('/log/find-all', 'index');
        Route::get('/log/find', 'find');
        Route::post('/log/create', 'store');
        Route::delete('/log/delete', 'delete');
        Route::patch('/log/update', 'update');
    });
});
