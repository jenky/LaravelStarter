<?php

/**
 * Environment Name => Providers.
 *
 * @return array
 */

return [
    'local' => [
        Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class,
        Barryvdh\Debugbar\ServiceProvider::class,
        Jenky\LaravelGenerators\GeneratorsServiceProvider::class,
    ],
];
