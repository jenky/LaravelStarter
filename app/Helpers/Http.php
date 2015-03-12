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

	public function responseApiError($status = 400, $code = null, $message = '')
    {
        $statusTexts = \Symfony\Component\HttpFoundation\Response::$statusTexts;

        $_code = $code ? $code : $status;
        $message = (isset($statusTexts[$_code]) && !$message) ? $statusTexts[$_code] : $message;

        return \Response::json([
            'error' => [
                'code' => $_code,
                'message' => $message
            ]
        ], $status);
    }
}