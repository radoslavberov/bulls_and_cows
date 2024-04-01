<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
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
// Display the game's main page
Route::get('/game/play', [GameController::class, 'play'])->name('game.play');

// Start a new game
Route::post('/game/start', [GameController::class, 'start'])->name('game.start');

// Handle a user's guess
Route::post('/game/guess', [GameController::class, 'guess'])->name('game.guess');

// Finish the game
//Route::get('/game/finish', [GameController::class, 'finish'])->name('game.finish');
Route::post('/game/finish', [GameController::class, 'finish'])->name('game.finish');
