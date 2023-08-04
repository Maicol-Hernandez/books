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

/**
 * =================================
 * books
 * =================================
 */
Route::get('/', [PanelController::class, 'index'])->name('panel.index');
Route::resource('books', BookController::class);

Route::get('users', [UserController::class, 'index'])->name('users.index');
Route::post('users/admin/{user}', [UserController::class, 'toggleAdmin'])->name('users.admin.toggle');
