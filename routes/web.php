<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

//$router->get('/', 'ResourceController@layout');

Route::get('/', [\App\Http\Controllers\IndexController::class, 'show']);
Route::get('/kategorie/{name}', [\App\Http\Controllers\CategoryController::class, 'show']);
Route::get('/produkt/{name}', [\App\Http\Controllers\ProductController::class, 'show']);
Route::get('/stranka/{name}', [\App\Http\Controllers\PageController::class, 'show']);
Route::get('/kosik', [\App\Http\Controllers\CartController::class, 'show']);
Route::get('/cart-complete', [\App\Http\Controllers\CartController::class, 'complete']);

Route::post('newsletter/addNewContact', [\App\Http\Controllers\NewsletterController::class, 'addNewContact']);

Route::post('addToCart', [\App\Http\Controllers\CartController::class, 'add']);
Route::post('updateCartItem', [\App\Http\Controllers\CartController::class, 'update']);
Route::post('deleteCartItem', [\App\Http\Controllers\CartController::class, 'delete']);

Route::post('updateOrder', [\App\Http\Controllers\OrderController::class, 'update']);
Route::post('submitOrder', [\App\Http\Controllers\OrderController::class, 'submit']);