<?php

use App\Http\Controllers\Api\MenuController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProfileController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/register', App\Http\Controllers\Api\RegisterController::class)->name('register');
Route::post('/login', App\Http\Controllers\Api\LoginController::class)->name('login');
Route::post('/logout', App\Http\Controllers\Api\LogoutController::class)->name('logout');

Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');
Route::post('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');

Route::get('/menu', [MenuController::class, 'index'])->name('menus.index');
Route::post('/menu/add', [MenuController::class, 'store'])->name('menu.store');
Route::get('/menu/{id}', [MenuController::class, 'show'])->name('menu.show');
Route::post('/menu/{id}', [MenuController::class, 'update'])->name('menu.update');
Route::delete('/menu/{id}', [MenuController::class, 'destroy'])->name('menu.destroy');

// use App\Http\Controllers\Api\ProfileController;

// Route::put('profiles/{id}', [ProfileController::class, 'edit']);
// use App\Http\Controllers\Api\ProfileController;
// Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
