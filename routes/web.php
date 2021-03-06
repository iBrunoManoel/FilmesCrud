<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FilmesController;
use App\Http\Controllers\TagController;

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

Route::get('/', [App\Http\Controllers\FilmesController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\FilmesController::class, 'index'])->name('home');

Route::resource('/filmes', FilmesController::class)->middleware('auth');

Route::resource('/tags', TagController::class)->middleware('auth');
