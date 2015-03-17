<?php

if (!function_exists('array_rewrite')) 
{
    /**
     * Replace root array key with child array key
     * 
     * Note that the specified key must exist in the query result, or it will be ignored.
     *
     * @param array|$data
     * @param string|$key
     *
     * @return array
     */

    function array_rewrite(array $data, $key) 
    {
        $output = array();

        foreach ($data as $_key => $value) 
        {
            $output[(isset($value[$key])) ? $value[$key] : $_key] = $value;
        }

        return $output;
    }
}

if (!function_exists('datetime')) 
{
    /**
     * Parse datetime with Carbon
     * 
     * @param mixed|$time Carbon supported time
     * @param string|$timezone Output timezone, try to catch from users table if not set
     * 
     * @return Carbon
     */ 

    function datetime($time, $timezone = null)
    {
        $defaultTz = config('app.timezone');

        if (!$timezone && !empty(Auth::user()->timezone))
        {
            $timezone = Auth::user()->timezone;
        }

        if (!in_array($timezone, timezone_identifiers_list()))
        {
            $timezone = false;
        }

        if ($timezone)
        {
            return Carbon::parse($time, $defaultTz)->setTimezone($timezone);
        }

        return Carbon::parse($time, $defaultTz); 
    }
}

if (!function_exists('get_fullname')) 
{
    function get_fullname($user, $first_name = 'first_name', $last_name = 'last_name') 
    {
        $firstname = $lastname = '';

        if (is_object($user))
        {
            $firstname = isset($user->$first_name) ? $user->$first_name : '';
            $lastname = isset($user->$last_name) ? $user->$last_name : '';
        }

        if (is_array($user))
        {
            $firstname = isset($user[$first_name]) ? $user[$first_name] : '';
            $lastname = isset($user[$last_name]) ? $user[$last_name] : '';
        }

        $fullname = $firstname . ' ' . $lastname;

        return $fullname;
    }
}

if (!function_exists('get_helper')) 
{
    /**
     * Create helper object in App\Helpers
     * 
     * @return object
     */ 

	class HelperCache {

		protected static $helpers;

		public static function getHelper($class)
		{
			if (!isset(static::$helpers[$class]))
			{
				static::$helpers[$class] = new $class;
			}

			return static::$helpers[$class];
		}
	}

    function get_helper($helperClass, $namespace = '\\App\\Helpers\\') 
    {
        $class = $namespace . $helperClass;

        return HelperCache::getHelper($class);
    }
}

if (!function_exists('prd'))
{
    /**
     * Print the passed variables and end the script.
     *
     * @param  mixed
     * @return void
     */
    function prd()
    {
        array_map(function($x) { 
            echo '<pre>';
            print_r($x); 
            echo '</pre>';
        }, func_get_args());
        die;
    }
}

if (!function_exists('vd')) 
{
    /**
     * Dump the passed variables using var_dump and end the script.
     *
     * @param  mixed
     * @return void
     */
    function vd()
    {
        array_map(function($x) { var_dump($x);die; }, func_get_args());
    }
}