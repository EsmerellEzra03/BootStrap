<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('admin-view', [HomeController::class, 'adminView'])->name('admin.view');
 });
//  Route::group(['middleware' => ['auth', 'admin']], function () {
//     Route::get('admin-view', 'HomeController@adminView')->name('admin.view');
// });

//Todos Routes
Route::get('/todos/index', [App\Http\Controllers\TodosController::class, 'index'])->name('todos:index');

Route::get('/todos/create', [App\Http\Controllers\TodosController::class, 'create'])->name('todos:create');

Route::post('/todos/store', [App\Http\Controllers\TodosController::class, 'store'])->name('todos:store');

Route::get('/todos/show/{todos}', [App\Http\Controllers\TodosController::class, 'show'])->name('todos:show');

Route::post('/todos/edit/{todos}', [App\Http\Controllers\TodosController::class, 'edit'])->name('todos:edit');

Route::get('/todos/destroy/{todos}', [App\Http\Controllers\TodosController::class, 'destroy'])->name('todos:destroy');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
