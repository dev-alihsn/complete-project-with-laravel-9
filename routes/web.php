<?php

use App\Http\Controllers\listingController;
use App\Http\Controllers\UserController;
use App\Models\Listing;
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

Route::get('/', [listingController::class, 'index']);

Route::get('listings/create' , [listingController::class, 'create'])->middleware('auth');

Route::get('/listings/mange',[listingController::class, 'mange'])->name('mange')->middleware('auth');

Route::post('/listings',[listingController::class, 'store'])->middleware('auth');

Route::get('/listings/{listing}/edit',[listingController::class, 'edit'])->middleware('auth');

Route::put('/listings/{listing}',[listingController::class, 'update'])->middleware('auth');

Route::delete('/listings/{listing}',[listingController::class, 'destroy'])->middleware('auth');

Route::get('/listings/{listing}',[listingController::class, 'show'])->middleware(['guest','auth']);

// user routes
Route::get('/register' , [UserController::class, 'create'])->middleware('guest');

Route::post('/users', [UserController::class, 'store'])->middleware('guest');

// logout
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// login
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

Route::post("/users/authenticate",[UserController::class, 'authenticate'])->middleware('auth');