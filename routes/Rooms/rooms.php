<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\Rooms\RoomsController;
use App\Http\Controllers\API\v1\Rooms\RoomPricingController;
use App\Http\Controllers\API\V1\Rooms\RoomReviewsController;

Route::apiResource('/rooms', RoomsController::class);
Route::apiResource('/reviews', RoomReviewsController::class);
Route::apiResource('/pricing', RoomPricingController::class);
