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
Route::post('/send-book', [\App\Http\Controllers\SubscribeController::class, 'sendBook']);