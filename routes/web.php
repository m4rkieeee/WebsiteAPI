<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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
    return redirect('./home');
});

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('custom-login', [AuthController::class, 'customLogin'])->name('login.custom');
Route::get('registration', [AuthController::class, 'registration'])->name('register.user');
Route::post('custom-registration', [AuthController::class, 'customRegistration'])->name('register.custom');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('todo/actions', [App\Http\Controllers\todoController::class, 'actions'])->name('todo.actions');
Route::get('signout', [AuthController::class, 'signOut'])->name('signOut');
Route::delete('todo/actions', [App\Http\Controllers\todoController::class, 'actions'])->name('todo.actions');

Route::get('/cards', [App\Http\Controllers\HomeController::class, 'cards'])->name('home');
