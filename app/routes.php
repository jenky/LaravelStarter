<?php

/*
|--------------------------------------------------------------------------
| Cache Buster Route
|--------------------------------------------------------------------------
|
| https://github.com/TheMonkeys/laravel-cachebuster
|
*/
/*Route::get('{path}', function($filename) 
{
    return Asset::css($filename);
})->where('path', '.*\.css$');

App::make('cachebuster.StripSessionCookiesFilter')->addPattern('|\.css$|');*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});
