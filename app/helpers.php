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