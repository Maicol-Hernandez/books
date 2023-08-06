<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\BookReservationController;

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

Route::get('/', [MainController::class, 'index'])->name('main');

Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
// Books Reservations
Route::resource('books.reservations', BookReservationController::class)->only(['store', 'destroy'])->middleware(['verified']);
/**
 * =================================
 * reservations
 * =================================
 */
Route::resource('reservations', ReservationController::class);
/**
 * =================================
 * orders
 * =================================
 */
Route::resource('orders', OrderController::class)->only(['create', 'store'])->middleware(['verified']);
// Books
Route::resource('books', BookController::class);

Auth::routes([
    'verify' => true,
    // 'reset' => false
]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
