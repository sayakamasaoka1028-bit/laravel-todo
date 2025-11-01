<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\CategoryController;
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
// URL '/' にアクセスがあったら TodoController の index メソッドを呼び出す
Route::get('/', [TodoController::class, 'index'])->name('todos.index');
// URL '/todos' にアクセスがあったら TodoController の post store メソッドを呼び出す
Route::post('/todos', [TodoController::class, 'store'])->name('todos.store');
Route::delete('/todos/{todo}', [TodoController::class, 'destroy'])->name('todos.destroy');
// 編集フォームを表示

Route::get('/todos/{todo}/edit', [TodoController::class, 'edit'])->name('todos.edit');

//CRUD用のルートをまとめて作成
Route::resource('categories', CategoryController::class);// カテゴリ追加用のルート
Route::match(['put', 'patch'], '/todos/{todo}', [TodoController::class, 'update'])->name('todos.update');
