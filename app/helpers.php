<?php

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
if (!function_exists('array_rewrite')) 
{
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

/**
 * Parse datetime with Carbon
 * 
 * @param mixed|$time Carbon supported time
 * @param string|$timezone Output timezone, try to catch from users table if not set
 * 
 * @return Carbon
 */ 
if (!function_exists('parse_datetime')) 
{
    function parse_datetime($time, $timezone = null)
    {
        $defaultTz = Config::get('app.timezone');

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