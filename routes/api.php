<?php

use App\Http\Controllers\V1\Auth\AuthController;
use App\Http\Controllers\V1\Users\UsersController;
use App\Http\Controllers\V1\WebHooks\Interrapidisimo\InterrapidisimoController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('create-user', [UsersController::class, 'store'])->name('create.user')->middleware('internal.user.ave');

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});
Route::group([
    'middleware' => 'webhook.middle',
    'prefix' => 'v1',
], function () {
    Route::apiResource('webhook-interrapidisimo', InterrapidisimoController::class);
});
