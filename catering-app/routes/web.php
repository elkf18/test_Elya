<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


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
    return view('welcome');
});
// use App\Http\Controllers\ProfileController;

// Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::post('/profile', App\Http\Controllers\ProfileController::class)->name('profile');
// Route::post('/profile', [App\Http\Controllers\ProfileController::class, 'store'])->name('profile.store');

