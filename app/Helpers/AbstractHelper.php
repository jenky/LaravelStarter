<?php

namespace App\Helpers;

use Illuminate\Contracts\Foundation\Application;

abstract class AbstractHelper
{
    /**
     * @var \Illuminate\Contracts\Foundation\Application
     */
    protected $app;

    /**
     * 
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }
}
