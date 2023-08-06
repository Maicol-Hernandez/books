<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Panel\BookController;
use App\Http\Controllers\Panel\UserController;
use App\Http\Controllers\Panel\PanelController;



/*
|--------------------------------------------------------------------------
| Admin Panel Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/', [PanelController::class, 'index'])->name('panel.index');
/**
 * =================================
 * books
 * =================================
 */
Route::resource('books', BookController::class);
/**
 * =================================
 * users
 * =================================
 */
Route::get('users', [UserController::class, 'index'])->name('users.index');
Route::post('users/admin/{user}', [UserController::class, 'toggleAdmin'])->name('users.admin.toggle');
