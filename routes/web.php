<?php

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

Route::get('/', function () {
    return view('welcome');
});
Route::resource('/projects',\App\Http\Controllers\ProjectController::class)->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/projects/{project}/tasks',[\App\Http\Controllers\TaskController::class,'store'])->name('addTask');
Route::patch('/projects/{project}/tasks/{task}',[\App\Http\Controllers\TaskController::class,'update'])->name('toggleTaskComplete');
Route::delete('/projects/{project}/tasks/{task}',[\App\Http\Controllers\TaskController::class,'destroy']);
Route::get('/profile',[\App\Http\Controllers\ProfileController::class,'index']);
Route::patch('/profile',[\App\Http\Controllers\ProfileController::class,'update']);
require __DIR__.'/auth.php';
