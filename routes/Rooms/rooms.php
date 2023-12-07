<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\Rooms\RoomReviewsController;
use App\Http\Controllers\API\V1\Rooms\RoomsController;
Route::apiResource('/rooms', RoomsController::class);
Route::apiResource('/reviews', RoomReviewsController::class);
