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

Route::get('/city/{id}', function ($id) {
    return view('city-details', ['id' => $id]);
})->name('city.show');



// Route::get('/print', function () {
//     $locations = Location::all();
//     return view('print', ['locations' => $locations]);
// });

Route::get('/locations', [LocationsController::class, 'index'])->name('locations');



Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');

Route::get('/page', [PageController::class, 'showPage'])->name('page');

Route::controller(PostController::class)->group(function(){
    Route::get('/posts', 'index')->name('posts.index');
    Route::post('/posts', 'store')->name('posts.store');
});

// Route::get('/posts', [PostController::class, 'index'])->name('page');
// Route::post('posts', [PostController::class, 'store'])->name('posts.store');


