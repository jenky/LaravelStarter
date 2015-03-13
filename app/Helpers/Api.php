<?php namespace App\Helpers;

use Symfony\Component\HttpFoundation\Response;

class Api extends Http {

	public static $customStatusTexts = [
		// 1000 => 'Missing required field'
	];

	protected static $errors;

	public function responseError($code = null, $message = '', $status = 400)
    {
        return $this->error($code, $message)->response($status);
    }

    public function responseErrors(array $errors, $status = 400)
    {
    	return $this->errors($errors)->response($status);
    }

    public function getErrorMessage($code = null, $message = '')
    {
    	$statusTexts = static::$customStatusTexts + Response::$statusTexts;

        $_code = $code ? $code : $status;
        $message = (isset($statusTexts[$_code]) && !$message) ? $statusTexts[$_code] : $message;

        return [
            'code' => $_code,
            'message' => $message
        ];
    }

    public function error($code, $message = '')
    {
		static::$errors[] = $this->getErrorMessage($code, $message);

		return $this;
    }

    public function errors($errors)
    {
		static::$errors = (array) $errors;

		return $this;
    }

    public function response($status = 400)
    {
		return \Response::json([
		    'errors' => static::$errors
		], $status);
    }
}