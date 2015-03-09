<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		// Twig Spaceless equivalent
        \Blade::extend(function($view, $compiler){
            $pattern = $compiler->createPlainMatcher('spaceless');
            return preg_replace($pattern, '$1<?php ob_start(); ?>$2', $view);
        });
        \Blade::extend(function($view, $compiler){
            $pattern = $compiler->createPlainMatcher('endspaceless');
            return preg_replace($pattern, '$1<?php echo trim(preg_replace(\'/>\s+</\', \'><\', ob_get_clean())); ?>$2', $view);
        });
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

}
