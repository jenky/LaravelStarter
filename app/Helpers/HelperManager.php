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

    /**
     * Loaded helers.
     *
     * @var array
     */
    protected $loadedHelpers = [];

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
        $helper = $this->formatHelperName($helper);

        if (! isset($this->loadedHelpers[$helper])) {
            $this->loadedHelpers[$helper] = new $helper($this->app);
        }

        return $this->loadedHelpers[$helper];
    }

    protected function formatHelperName($helper)
    {
        $namespace = $this->app->getNamespace();

        if (! Str::contains($helper, $namespace)) {
            $helper = $namespace.'Helpers\\'.$helper;
        }

        return $helper;
    }
}
