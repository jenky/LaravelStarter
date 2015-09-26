<?php


namespace App\Helpers;

class Http extends AbstractHelper
{
    public function subdomainIs($pattern)
    {
        $subdomain = str_replace($this->app['config']['app.domain'], '', '.'.$_SERVER['HTTP_HOST']);

        if (str_contains($subdomain, $pattern)) {
            return true;
        }

        return false;
    }
}
