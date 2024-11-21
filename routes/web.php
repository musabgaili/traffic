<?php

use App\Http\Controllers\AdminTrafficLightController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('traffic-light.index');
});


// index
Route::get('/traffic-light', [AdminTrafficLightController::class, 'index'])->name('traffic-light.index');
// admin traffic light details
Route::get('/traffic-light/details/{id}', [AdminTrafficLightController::class, 'details'])->name('traffic-light.details');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes(['register' => false]);
