<?php

/**
 * Environment Name => Providers
 *
 * @return array
 */ 

return [
	'local' => [
		'Laracasts\Generators\GeneratorsServiceProvider',
		'Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider',
		'Barryvdh\Debugbar\ServiceProvider',
		'App\Providers\ErrorServiceProvider', // filp/whoops
	],
];