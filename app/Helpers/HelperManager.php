<?php 

namespace App\Helpers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Str;

class HelperManager 
{
    /**
     * @var \Illuminate\Contracts\Foundation\Application
     */
    protected $app;

    /**
     * Helper instance.
     * 
     * @var object
     */
    protected $helper;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Create new helper instance.
     * 
     * @param mixed $helper
     * 
     * @return void
     */
    public function make($helper)
    {
        $namespace = $this->app->getNamespace();

        if (!Str::contains($helper, $namespace))
        {
            $helper = $namespace.'Helpers\\'.$helper;
        }

        return $this->helper = new $helper($this->app);
    }

    /**     
     * Dynamically call the query builder.     
     *     
     * @param  string  $method     
     * @param  array   $parameters     
     * @return mixed       
     */        
    public function __call($method, $parameters)     
    {
        return call_user_func_array([$this->helper, $method], $parameters);     
    }
}