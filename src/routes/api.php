<?php

use App\Http\Controllers\Api\FetchTaskBoardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    Route::group(['prefix' => '/projects/{projectId}'], function () {
        // Task
        Route::get('/tasks/fetch-board', FetchTaskBoardController::class)->name('tasks.fetch-board');
    });
});
