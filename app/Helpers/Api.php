<?php namespace App\Helpers;

use Symfony\Component\HttpFoundation\Response;

class Api extends Http {

	/**
	 * List of custom error codes and messages
	 * 
	 * @var array
	 */ 
	public static $customStatusTexts = [
		// 1000 => 'Missing required field'
	];

	/**
	 * List Erros
	 * 
	 * @var array
	 */ 
	protected static $errors = [];

	/**
	 * Respone json errors payload
	 * 
	 * @param int $code
	 * @param string $message
	 * @param int $status
	 * 
	 * @return \Response
	 */ 
	public function responseError($code = null, $message = '', $status = 400)
    {
        return $this->error($code, $message)->response($status);
    }

    /**
	 * Respone json errors payload
	 * 
	 * @param array $errors
	 * @param string $message
	 * @param int $status
	 * 
	 * @return \Response
	 */ 
    public function responseErrors(array $errors, $status = 400)
    {
    	return $this->errors($errors)->response($status);
    }

    /**
	 * Get error message based on http error codes and custom error codes
	 * 
	 * @param int $code
	 * @param string $message
	 * 
	 * @return array
	 */ 
    public function getErrorMessage($code, $message = '')
    {
    	$statusTexts = static::$customStatusTexts + Response::$statusTexts;

        $message = (isset($statusTexts[$code]) && !$message) ? $statusTexts[$code] : $message;

        return [
            'code' => $code,
            'message' => $message
        ];
    }

    /**
     * Set error code and message
     * 
     * @param int $code
     * @param string $message
     * 
     * @return App\Helpers\Api
     */ 
    public function error($code, $message = '')
    {
		static::$errors[] = $this->getErrorMessage($code, $message);

		return $this;
    }

    /**
     * Set error codes and messages
     * 
     * @param array $errors
     * 
     * @return App\Helpers\Api
     */ 
    public function errors($errors)
    {
		static::$errors = (array) $errors;

		return $this;
    }

    /**
	 * Respone json errors payload
	 * 
	 * @param int $status
	 * 
	 * @return \Response
	 */ 
    public function response($status = 400)
    {
		$errors = static::$errors;
		static::$errors = [];

		return \Response::json([
		    'errors' => $errors
		], $status);
    }
}