<?php

use Illuminate\Support\Facades\Route;
use App\Models\Task;
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

Route::get('/task', [App\Http\Controllers\TaskController::class, 'index'])->name('home');

Route::get('/task/create', [App\Http\Controllers\TaskController::class, 'create'])->name('tasks.add');

Route::get('/task/{id}/change-completed', [App\Http\Controllers\TaskController::class, 'updateCompleted'])->name('tasks.change-completed');

Route::post('/task/store', [App\Http\Controllers\TaskController::class, 'store'])->name('tasks.store');


Auth::routes();

