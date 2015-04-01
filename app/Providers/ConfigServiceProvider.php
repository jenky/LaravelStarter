<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use EnvLoader;

class ConfigServiceProvider extends ServiceProvider {

	/**
	 * Overwrite any vendor / package configuration.
	 *
	 * This service provider is intended to provide a convenient location for you
	 * to overwrite any "vendor" or package configuration that you may want to
	 * modify before the application handles the incoming request / command.
	 *
	 * @return void
	 */
	public function register()
	{
		config([
			//
		]);

        EnvLoader::loadConfigs();

        /* Set config domain */
        $parse = parse_url(config('app.url'));
        config([
            'app.domain' => $parse['host']
        ]);
	}

}
