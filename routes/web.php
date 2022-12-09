<?php

use App\Http\Controllers\Admin\GameController as AdminGameController;
use App\Http\Controllers\User\GameController as UserGameController;
use App\Http\Controllers\User\PublisherController as UserPublisherController;
use App\Http\Controllers\Admin\PublisherController as AdminPublisherController;

use Database\Seeders\GameSeeder;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/games', function () {
    return view('games');
})->middleware(['auth', 'verified'])->name('games');

require __DIR__.'/auth.php';

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home/publishers', [App\Http\Controllers\HomeController::class, 'publisherIndex'])->name('home.publisher.index');

// Route::resource("/games", GameController::class)->middleware(['auth']);

// Route::get('/index', [GameController::class, "index"])->middleware(["auth"]);

// Creates routes for Games and will only work for the user that is logged in at the time

Route::resource('/admin/games', AdminGameController::class)->middleware(['auth'])->names('admin.games');

Route::resource('/user/games', UserGameController::class)->middleware(['auth'])->names('user.games')->only(['index','show']);

// This will create all the routes for Publisher functionality.
// and the routes will only be available when a user is logged in
Route::resource('/admin/publishers', AdminPublisherController::class)->middleware(['auth'])->names('admin.publishers');

// the ->only at the end of this statement says only create the index and show routes.
Route::resource('/user/publishers',UserPublisherController::class)->middleware(['auth'])->names('user.publishers')->only(['index', 'show']);