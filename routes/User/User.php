<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\UserData\UserInfo;
use App\Http\Controllers\API\v1\UserData\ChatController;

Route::apiResource('/users', UserInfo::class);
Route::apiResource('/chat', ChatController::class);
