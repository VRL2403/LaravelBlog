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
    return redirect('/login');
});
Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('/dashboard', "\App\Http\Controllers\Admin\PostController@index")->name('dashboard');
    Route::get('/post/create', "\App\Http\Controllers\Admin\PostController@create");
    Route::post('/post/save', "\App\Http\Controllers\Admin\PostController@store");
    Route::get('/post/edit', "\App\Http\Controllers\Admin\PostController@edit");
    Route::post('/post/delete', "\App\Http\Controllers\Admin\PostController@delete");
});
