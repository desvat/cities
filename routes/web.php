<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LocationsController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\HtmlParseController;


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

Route::get('/city/{id}', [CityController::class, 'showDetail'])->name('city.showDetail');

Route::get('/page', [PageController::class, 'showPage'])->name('page');

Route::get('/city-search', [CityController::class, 'searchByName'])->name('city-search');
Route::get('/parse/{district}', [HtmlParseController::class, 'parseCitiesDetails'])->name('parse.city.details');

Route::prefix('/cities')->group(function () {
    Route::get('/', [HtmlParseController::class, 'showAllCities'])->name('cities');
});

