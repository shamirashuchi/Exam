<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('todo-list');
// });

Route::get('/',[TodoController::class,'showList']);

Route::post('/add-to-list',[TodoController::class,'addToList'])->name('addToList');
Route::delete('/delete-todo/{id}', [TodoController::class, 'deleteTodo']);
Route::put('/update-todo/{id}', [TodoController::class, 'updateTodo']);
