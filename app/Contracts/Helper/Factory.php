<?php

namespace App\Contracts\Helper;

interface Factory
{
    /**
     * Create new helper instance.
     * 
     * @param mixed $helper
     * 
     * @return void
     */
    public function make($helper)
}