<?php

use Illuminate\Support\Facades\Route;
use App\Models\Item;
use App\Models\User;

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
Route::get('/index', 'App\Http\Controllers\ItemsController@index');

Route::post('/itemedit/{item}', 'App\Http\Controllers\ItemsController@edit');

Route::post('/items', 'App\Http\Controllers\ItemsController@add');

Route::delete('/item/{item}', 'App\Http\Controllers\ItemsController@delete');

Route::post('/items/update', 'App\Http\Controllers\ItemsController@update');

Route::post('/signin', 'App\Http\Controllers\UserController@signin');

Route::post('/login', 'App\Http\Controllers\UserController@login');

Route::get('/useredit', 'App\Http\Controllers\UserController@edit');

Route::post('/user/update', 'App\Http\Controllers\UserController@update');