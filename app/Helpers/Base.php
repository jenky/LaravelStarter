<?php 

namespace App\Helpers;

class Base 
{
	public $app;

	public function __construct()
	{
		$this->app = app();
	}

	public static function __callStatic($method, $args)
	{
		$instance = new static;

		if (!method_exists($instance, $method)) 
		{
			throw new \Exception(get_called_class() . ' does not implement ' . $method . ' method.');
		}

		return call_user_func_array(array($instance, $method), $args);
	}
}