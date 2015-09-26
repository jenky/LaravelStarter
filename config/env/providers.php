<?php

/**
 * Environment Name => Providers.
 *
 * @return array
 */

return [
    'local' => [
        Laracasts\Generators\GeneratorsServiceProvider::class,
        Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class,
        Barryvdh\Debugbar\ServiceProvider::class,
    ],
];
