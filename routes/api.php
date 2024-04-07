<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Routes for User CRUD operations
Route::get('/users', 'App\Http\Controllers\UserController@index');
Route::post('/users', 'App\Http\Controllers\UserController@store');
Route::get('/users/{id}', 'App\Http\Controllers\UserController@show');
Route::put('/users/{id}', 'App\Http\Controllers\UserController@update');
Route::delete('/users/{id}', 'App\Http\Controllers\UserController@destroy');

// Routes for Product CRUD operations
Route::get('/products', 'App\Http\Controllers\ProductController@index');
Route::post('/products', 'App\Http\Controllers\ProductController@store');
Route::get('/products/{id}', 'App\Http\Controllers\ProductController@show');
Route::put('/products/{id}', 'App\Http\Controllers\ProductController@update');
Route::delete('/products/{id}', 'App\Http\Controllers\ProductController@destroy');

// Routes for Order CRUD operations
Route::get('/orders', 'App\Http\Controllers\OrderController@index');
Route::post('/orders', 'App\Http\Controllers\OrderController@store');
Route::get('/orders/{id}', 'App\Http\Controllers\OrderController@show');
Route::put('/orders/{id}', 'App\Http\Controllers\OrderController@update');
Route::delete('/orders/{id}', 'App\Http\Controllers\OrderController@destroy');

// Routes for Order Item CRUD operations
Route::get('/order-items', 'App\Http\Controllers\OrderItemController@index');
Route::post('/order-items', 'App\Http\Controllers\OrderItemController@store');
Route::get('/order-items/{id}', 'App\Http\Controllers\OrderItemController@show');
Route::put('/order-items/{id}', 'App\Http\Controllers\OrderItemController@update');
Route::delete('/order-items/{id}', 'App\Http\Controllers\OrderItemController@destroy');

// Routes for Contact CRUD operations
Route::get('/contacts', 'App\Http\Controllers\ContactController@index');
Route::post('/contacts', 'App\Http\Controllers\ContactController@store');
Route::get('/contacts/{id}', 'App\Http\Controllers\ContactController@show');
Route::put('/contacts/{id}', 'App\Http\Controllers\ContactController@update');
Route::delete('/contacts/{id}', 'App\Http\Controllers\ContactController@destroy');

// Routes for Category CRUD operations
Route::get('/categories', 'App\Http\Controllers\CategoryController@index');
Route::post('/categories', 'App\Http\Controllers\CategoryController@store');
Route::get('/categories/{id}', 'App\Http\Controllers\CategoryController@show');
Route::put('/categories/{id}', 'App\Http\Controllers\CategoryController@update');
Route::delete('/categories/{id}', 'App\Http\Controllers\CategoryController@destroy');

// Additional routes can be defined here as needed

