<?php


namespace app\Providers;

use Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Twig Spaceless equivalent
        Blade::directive('spaceless', function ($expression) {
            return "<?php ob_start();\n ?>";
        });

        Blade::directive('endspaceless', function ($expression) {
            return "<?php echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));\n ?>";
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
