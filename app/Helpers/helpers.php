<?php

if (! function_exists('array_rewrite')) {
    /**
     * Replace root array key with child array key.
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
        $output = [];

        foreach ($data as $_key => $value) {
            $output[(isset($value[$key])) ? $value[$key] : $_key] = $value;
        }

        return $output;
    }
}

if (! function_exists('datetime')) {
    /**
     * Parse datetime with Carbon.
     * 
     * @param mixed|$time Carbon supported time
     * @param string|$timezone Output timezone, try to catch from users table if not set
     * 
     * @return Carbon
     */
    function datetime($time = null, $timezone = null, $reverse = false)
    {
        $defaultTz = config('app.timezone');

        if (! $timezone && ! empty(auth()->user()->timezone)) {
            $timezone = auth()->user()->timezone;
        }

        if (! in_array($timezone, timezone_identifiers_list())) {
            $timezone = false;
        }

        if ($timezone) {
            if ($time instanceof Carbon\Carbon) {
                return $time->tz($timezone);
            }

            return $reverse
                ? Carbon::parse($time, $timezone)->tz($defaultTz)
                : Carbon::parse($time, $defaultTz)->tz($timezone);
        }

        return Carbon::parse($time, $defaultTz);
    }
}

if (! function_exists('helper')) {
    function helper($helper = null)
    {
        $helperManager = app('helper');

        if (is_null($helper)) {
            return $helperManager;
        }

        return $helperManager->make($helper);
    }
}

if (! function_exists('prd')) {
    /**
     * Print the passed variables and end the script.
     *
     * @param  mixed
     *
     * @return void
     */
    function prd()
    {
        array_map(function ($x) {
            echo '<pre>';
            print_r($x);
            echo '</pre>';
        }, func_get_args());
        die;
    }
}

if (! function_exists('vd')) {
    /**
     * Dump the passed variables using var_dump and end the script.
     *
     * @param  mixed
     *
     * @return void
     */
    function vd()
    {
        array_map(function ($x) { var_dump($x);die; }, func_get_args());
    }
}

if (! function_exists('get_update_rules')) {
    /**
     * Get the validation update rules.
     *
     * @param  array
     *
     * @return void
     */
    function get_update_rules(array $rules)
    {
        foreach ($rules as &$rule) {
            if (is_array($rule) && ! in_array('sometimes', $rule)) {
                array_unshift($rule, 'sometimes');
            } elseif (is_string($rule) && ! str_contains($rule, 'sometimes')) {
                $rule = 'sometimes|'.$rule;
            }
        }

        return $rules;
    }
}

if (! function_exists('get_rules')) {
    /**
     * Get the validation rules.
     *
     * @param  array $rules
     * @param int|null $id
     *
     * @return array
     */
    function get_rules(array $rules, $id = null)
    {
        foreach ($rules as $field => &$rule) {
            if (! is_array($rule)) {
                $rule = explode('|', $rule);
            }

            // This rule will be applied when perform the update.
            if ($id) {
                if (! in_array('sometimes', $rule)) {
                    array_unshift($rule, 'sometimes');
                }

                // Apply id to the unique rule.
                foreach ($rule as &$_rule) {
                    if (str_contains($_rule, 'unique')) {
                        $_rule .= ','.$field.','.$id;
                    }
                }
            }
        }

        return $rules;
    }
}

if (! function_exists('cache_buster')) {
    /**
     * Get the path to a versioned Elixir file.
     *
     * @param string $file
     *
     * @return string
     */
    function cache_buster($file, $prefix = 'assets')
    {
        static $manifest = null;

        if (is_null($manifest)) {
            $manifest = json_decode(file_get_contents(public_path($prefix).'/rev-manifest.json'), true);
        }

        if (isset($manifest[$file])) {
            return $prefix.'/'.$manifest[$file];
        }

        throw new InvalidArgumentException("File {$file} not defined in asset manifest.");
    }
}

if (! function_exists('random_filename')) {
    /**
     * Generate random filename.
     *
     * @param mixed $file
     * @param int   $length
     * @param Closure
     *
     * @return string
     */
    function random_filename($file, $length = 20, Closure $closure = null)
    {
        if ($file instanceof Symfony\Component\HttpFoundation\File\UploadedFile) {
            $extension = $file->getClientOriginalExtension();
        } else {
            $extension = pathinfo($file, PATHINFO_EXTENSION);
        }

        $name = str_random($length);

        if ($closure) {
            $name = $closure($name);
        }

        return $name.'.'.$extension;
    }
}

if ( ! function_exists('isset_default')) {

    /**
     * Get the default value if the variable is not set.
     */
    function isset_default($value, $default = null) {
        return isset($value) ? $value : $default;
    }
}

if ( ! function_exists('empty_default')) {

    /**
     * Get the default value if the variable is not empty.
     */
    function empty_default($value, $default = null) {
        return !empty($value) ? $value : $default;
    }
}

if (! function_exists('get_domain')) {
    /**
     * Get the domain name from url.
     * 
     * @param string $url
     *
     * @return string
     */
    function get_domain($url)
    {
        $pieces = parse_url($url);
        $domain = isset($pieces['host']) ? $pieces['host'] : '';

        if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
            return $regs['domain'];
        }

        return false;
    }
}

if (! function_exists('root_domain')) {
    /**
     * Replace the subdomain with domain.
     * 
     * @param string $url
     *
     * @return string
     */
    function root_domain($url)
    {
        $pieces = parse_url($url);
        $host = isset($pieces['host']) ? $pieces['host'] : '';
        $domain = get_domain($url);

        return str_replace($host, $domain, $url);
    }
}
