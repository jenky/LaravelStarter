<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

$domain = config('app.domain');

Route::group(['domain' => 'api.' . $domain, 'middleware' => 'cors'], function()
{
    Route::any('/', function () {
        return view('welcome');
    });

    Route::group(['namespace' => 'API\v1', 'prefix' => 'v1'], function()
    {
        Route::resources([
            
        ]);
    });
});

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::get('/', function () {
    return view('welcome');
});
