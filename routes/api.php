<?php

use App\Http\Controllers\V1\Auth\AuthController;
use App\Http\Controllers\V1\Users\UsersController;
use App\Http\Controllers\V1\WebHooks\Interrapidisimo\InterrapidisimoController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
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

Route::post('create-user', [UsersController::class, 'store'])->name('create.user');

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::group(['middleware' => 'api', 'prefix' => 'auth'], function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('refresh', [AuthController::class, 'refresh'])->name('refresh');
    Route::post('me', [AuthController::class, 'me'])->name('me');
});

// Route::group(['middleware' => 'webhook.middle', 'prefix' => 'v1'], function () {});



Route::middleware(['throttle:6,1'])->group(function () {
    Route::get('/email/verify', function (Request $request) {
        return response()->json(['message' => 'Verify your email address by clicking the link sent to your email.']);
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return response()->json(['message' => 'Email verified successfully.']);
    })->middleware(['signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return response()->json(['message' => 'Verification link sent!']);
    })->name('verification.send');
});
