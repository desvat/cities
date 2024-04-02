<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LocationsController;
use App\Http\Controllers\MemberController;


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

// Route::get('/city/{id}', function ($id) {
//     return view('city-details', ['id' => $id]);
// })->name('city.show');

Route::get('/city/{id}', [CityController::class, 'showDetail'])->name('city.showDetail');

Route::get('/locations', [LocationsController::class, 'index'])->name('locations');

Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');

Route::get('/page', [PageController::class, 'showPage'])->name('page');

Route::get('/city-search', [CityController::class, 'searchByName'])->name('city-search');
