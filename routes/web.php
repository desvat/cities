<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CityController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/city/{id}', function ($id) {
    return view('city-details', ['id' => $id]);
})->name('city.show');








Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');

Route::get('/page', [PageController::class, 'showPage'])->name('page');
