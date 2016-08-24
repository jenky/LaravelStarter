<?php

/**
 * Environment Name => Providers.
 *
 * @return array
 */

return [

    'local' => [
        Barryvdh\Debugbar\ServiceProvider::class,
        Jenky\LaravelGenerators\GeneratorsServiceProvider::class,
    ],

];
