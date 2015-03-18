<?php namespace App\Helpers;

class Http extends Base {

	public function subdomainIs($pattern)
	{
		$subdomain = str_replace(config('app.domain'), '', '.' . $_SERVER['HTTP_HOST']);
		
		if (str_contains($subdomain, $pattern))
		{
			return true;
		}

		return false;
	}
}