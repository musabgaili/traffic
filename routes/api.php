<?php

use App\Http\Controllers\TrafficLightController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



// set traffic light status
Route::post('/traffic-light/status', [TrafficLightController::class, 'setStatus']);

// set traffic light color
Route::post('/traffic-light/color', [TrafficLightController::class, 'setLightColor']);

// set car count
Route::post('/traffic-light/car-count', [TrafficLightController::class, 'carCount']);
