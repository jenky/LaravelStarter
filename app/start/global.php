<?php

/*
|--------------------------------------------------------------------------
| Register The Laravel Class Loader
|--------------------------------------------------------------------------
|
| In addition to using Composer, you may use the Laravel class loader to
| load your controllers and models. This is useful for keeping all of
| your classes in the "global" namespace without Composer updating.
|
*/

ClassLoader::addDirectories(array(

	app_path().'/commands',
	app_path().'/controllers',
	app_path().'/models',
	app_path().'/database/seeds',

));

/*
|--------------------------------------------------------------------------
| Application Error Logger
|--------------------------------------------------------------------------
|
| Here we will configure the error logger setup for the application which
| is built on top of the wonderful Monolog library. By default we will
| build a basic log file setup which creates a single file for logs.
|
*/

Log::useFiles(storage_path().'/logs/laravel.log');

/*
|--------------------------------------------------------------------------
| Application Error Handler
|--------------------------------------------------------------------------
|
| Here you may handle any errors that occur in your application, including
| logging them or displaying custom views for specific errors. You may
| even register several error handlers to handle different types of
| exceptions. If nothing is returned, the default error view is
| shown, which includes a detailed stack trace during debug.
|
*/

App::error(function(Exception $exception, $code)
{
	Log::error($exception);


    /**
     * Custom error handlers
     *
     * Careful here, any codes which are not specified
     * will be treated as 500
     * 404 not found will be taken care by @link App::missing below
     */

    $codes = array(401, 403);
    if (!Config::get('app.debug'))
    {
        $codes[] = 500;
    }
 
    if (in_array($code, $codes))
    {
        $view = "errors.$code";
 
        $data = array('code' => $code);
 
        return Response::view($view, $data, $code);
    }
});

/**
 * 404 Error Handler
 */ 

App::missing(function($exception)
{
    return View::make('errors.404');
});

/**
 * Eloquent error handler, listen for the ModelNotFoundException
 */ 
use Illuminate\Database\Eloquent\ModelNotFoundException;

App::error(function(ModelNotFoundException $e)
{
    return View::make('errors.404');
});

/*
|--------------------------------------------------------------------------
| Maintenance Mode Handler
|--------------------------------------------------------------------------
|
| The "down" Artisan command gives you the ability to put an application
| into maintenance mode. Here, you will define what is displayed back
| to the user if maintenance mode is in effect for the application.
|
*/

App::down(function()
{
	return Response::make("Be right back!", 503);
});

/*
|--------------------------------------------------------------------------
| Require The Filters File
|--------------------------------------------------------------------------
|
| Next we will load the filters file for the application. This gives us
| a nice separate location to store our route and application filter
| definitions instead of putting them all in the main routes file.
|
*/

require app_path().'/filters.php';

/*
|--------------------------------------------------------------------------
| Custom
|--------------------------------------------------------------------------
|
| Add our custom configs, functions, etc.
|
*/

/**
 * Set Config Domain
 */ 

$parse = parse_url(Config::get('app.url'));
Config::set('app.domain', $parse['host']);

/**
 * Blade extended
 */ 

// Twig Spaceless equivalent
Blade::extend(function($view, $compiler){
    $pattern = $compiler->createPlainMatcher('spaceless');
    return preg_replace($pattern, '$1<?php ob_start(); ?>$2', $view);
});

Blade::extend(function($view, $compiler){
    $pattern = $compiler->createPlainMatcher('endspaceless');
    return preg_replace($pattern, '$1<?php echo trim(preg_replace(\'/>\s+</\', \'><\', ob_get_clean())); ?>$2', $view);
});

// Twig Set equivalent: @set('variable', 'value')
Blade::extend(function($view, $compiler){
    return preg_replace("/@set\('(.*?)'\,(.*)\)/", '<?php $$1 = $2; ?>', $view); 
});

// Normal PHP code: {{% insert php code here %}}
/*Blade::extend(function($view, $compiler){
    return preg_replace("/\{\{\%(.*?)\%\}\}/", '<?php $1 ?>', $view); 
});*/