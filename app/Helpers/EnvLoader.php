<?php namespace App\Helpers;

/**
 * WARNING - DEPRECATED
 * 
 * This class no longer in use, please use this package
 * composer require jenky/laravel-envloader ~1.0
 * 
 * @see https://github.com/jenky/laravel-envloader
 * 
 */

use Illuminate\Foundation\AliasLoader;

class EnvLoader extends Base {

	protected $loader;

	public function __construct()
	{
		parent::__construct();
		$this->loader = AliasLoader::getInstance();
	}

	public function loadEnvConfigs()
	{
		$configs = config('env.configs');

		if (is_null($configs))
		{
			return false;
		}

		foreach ($configs as $env => $config) 
		{
			if ($this->app->environment($env)) 
			{
				if (!empty($config) && is_array($config))
				{
					$config = array_dot($config);
					config($config);
				}
			}
		}

		return $this;
	}

	public function loadEnvProviders()
	{
		$configs = config('env.providers');

		if (is_null($configs))
		{
			return false;
		}

		foreach ($configs as $env => $config) 
		{
			if ($this->app->environment($env)) 
			{
				if (!empty($config) && is_array($config))
				{
					foreach ($config as $_config) 
					{
						$this->app->register($_config);
					}        				
				}
			}
		}

		return $this;
	}

	public function loadEnvAliases()
	{
		$configs = config('env.aliases');

		if (is_null($configs))
		{
			return false;
		}

		foreach ($configs as $env => $config) 
		{
			if ($this->app->environment($env)) 
			{
				if (!empty($config) && is_array($config))
				{
					foreach ($config as $alias => $class) 
					{
						$this->loader->alias($alias, $class);
					}        				
				}
			}
		}

		return $this;
	}
}