<?php namespace App\Helpers;

class Http extends Base {

	public function subdomainIs($pattern)
	{
		$subdomain = str_replace(config('app.domain'), '', '.' . $_SERVER['HTTP_HOST']);
		
		if (strpos($subdomain, $pattern) !== false)
        {
      		return true;
        }

        return false;
	}
}