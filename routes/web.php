<?php

use App\Http\Controllers\GameController;
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


Route::get('/home', function () {
    return view('home');
});


Route::resource("/games", GameController::class)->middleware(['auth']);

Route::get('/index', [GameController::class, "index"])->middleware(["auth"]);