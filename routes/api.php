<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\UserData\UserInfo;
use App\Http\Controllers\API\V1\Auth\ResetPassword;
use App\Http\Controllers\API\V1\Auth\LoginController;
use App\Http\Controllers\API\v1\UserData\ChatController;
use App\Http\Controllers\API\v1\Auth\EmailVerificationController;
use App\Http\Controllers\API\v1\Auth\EmailVerificationSenderController;
use App\Http\Controllers\API\v1\Rooms\RoomImagesController;

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

Route::prefix('v1')->group(function () {
    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout']);
    Route::post('register', [UserInfo::class, 'store']);
    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        require __DIR__ . '/User/User.php';
    });
    Route::post('reset-password', [ResetPassword::class, 'emailForgotPassword'])
    ->middleware('signed');
    Route::apiResource('/chat', ChatController::class);
    Route::apiResource('/roomImages', RoomImagesController::class);
    require __DIR__ . '/Rooms/rooms.php';
});

