<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ItemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::namespace('Api')->prefix('v1')->group(function () {
    Route::post('item/create', [ItemController::class, 'create']);
    Route::post('item/delete', [ItemController::class, 'delete']);
    Route::post('item/edit', [ItemController::class, 'edit']);
    Route::get('item/find', [ItemController::class, 'find']);

    Route::post('category/create', [CategoryController::class, 'create']);
    Route::post('category/delete', [CategoryController::class, 'delete']);
});
