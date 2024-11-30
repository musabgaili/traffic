<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminTrafficLightController;
use App\Models\Ras;
use App\Models\TrafficLight;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('ras.index');
});


// index
Route::get('/ras', [AdminController::class, 'index'])->name('ras.index');
// admin ras details
Route::get('/ras/details/{id}', [AdminController::class, 'details'])->name('ras.details');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes(['register' => false]);



Route::get('/xnx', function () {
    return Ras::all();
});




// update message
Route::put('/rasgroup/{id}/update-message', [AdminController::class, 'updateMessage'])->name('rasgroup.update-message');

// assign ras to group
Route::post('/ras/assign-group', [AdminController::class, 'assignGroup'])->name('ras.assign-group');



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
| Main Routes:
| - / : Redirects to traffic light index page
| - /traffic-light : Shows overview of all traffic lights
| - /home : Dashboard home page
|
| Authentication:
| - Login routes enabled
| - Registration disabled for security
| - Protected by auth middleware
| - Default login:
|   Email: admin@admin.com
|   Password: password
|
| Note: All admin routes require authentication
*/




