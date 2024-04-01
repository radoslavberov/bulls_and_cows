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
Route::get('/', [GameController::class, 'index'])->name('index');
Route::post('/game/start-new', [GameController::class, 'startNewGame'])->name('game.start-new');
Route::get('/game/play', [GameController::class, 'play'])->name('game.play');
Route::post('/game/start', [GameController::class, 'start'])->name('game.start');
Route::post('/game/guess', [GameController::class, 'guess'])->name('game.guess');
Route::post('/game/finish', [GameController::class, 'finish'])->name('game.finish');
