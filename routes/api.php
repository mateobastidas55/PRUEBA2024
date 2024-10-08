<?php

use App\Http\Controllers\V1\Admin\AdminController;
use App\Http\Controllers\V1\Auth\AuthController;
use App\Http\Controllers\V1\Lotteries\BuyLotteriesController;
use App\Http\Controllers\V1\Lotteries\LotteryController;
use App\Http\Controllers\V1\Notification\NotificationMethodsController;
use App\Http\Controllers\V1\Users\UsersController;
use App\Http\Controllers\V1\WebHooks\Interrapidisimo\InterrapidisimoController;
use App\Models\User;
use Carbon\Carbon;
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

Route::post('login', [AuthController::class, 'login'])->name('login');

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('refresh', [AuthController::class, 'refresh'])->name('refresh');
    Route::post('me', [AuthController::class, 'me'])->name('me');
});

Route::group(['middleware' => 'loteria.middle', 'prefix' => 'v1'], function () {

    Route::put('update-notification-method', [UsersController::class, 'update'])->name('update.notification.method');

    /**
     * metodos de notificacion
     */
    Route::apiResource('methods-notifications', NotificationMethodsController::class);

    /**
     * todas las loterias
     */
    Route::apiResource('lotteries', LotteryController::class);


    /**
     * comprar loterias
     */
    Route::apiResource('buy-lotteries', BuyLotteriesController::class);



    Route::group(['middleware' => 'admin.middle'], function () {
        /**
         * endpoints de rutas que solo tiene acceso el admin
         */
        Route::apiResource('admin-route', AdminController::class);
    });
});




Route::get('/email/verify/{id}/{hash}', function ($request) {

    User::where('id', intval($request))->update(['email_verified_at' => Carbon::now()]);
    return response()->json([
        'success' => true,
        'message' => 'Email verified successfully.'
    ]);
})->middleware(['signed'])->name('verification.verify');
