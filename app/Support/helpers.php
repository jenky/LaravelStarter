<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\File\UploadedFile;

if (! function_exists('array_key_by')) {
    /**
     * Replace root array key with child array key.
     * Note that the specified key must exist in the query result, or it will be ignored.
     *
     * @param  array $data
     * @param  string $key
     * @return array
     */
    function array_key_by(array $data, $key): array
    {
        $output = [];

        foreach ($data as $k => $value) {
            $output[(isset($value[$key])) ? $value[$key] : $k] = $value;
        }

        return $output;
    }
}

if (! function_exists('datetime')) {
    /**
     * Parse datetime with Carbon.
     *
     * @param  mixed $time
     * @param  \DateTimeZone|string|array|null $tz
     * @return \Carbon\Carbon
     */
    function datetime($time = null, $tz = null): Carbon
    {
        if (is_array($time)) {
            [$format, $time] = $time;
            $datetime = Carbon::createFromFormat($format, $time, $tz);
        } else {
            $datetime = Carbon::parse($time, $tz);
        }

        return $datetime;
    }
}

if (! function_exists('random_filename')) {
    /**
     * Generate random filename.
     *
     * @param  mixed $file
     * @param  int $length
     * @param  \Closure|null
     * @return string
     */
    function random_filename($file, $length = 20, Closure $closure = null): string
    {
        if ($file instanceof UploadedFile) {
            $extension = $file->getClientOriginalExtension();
        } else {
            $extension = pathinfo($file, PATHINFO_EXTENSION);
        }

        $name = Str::random($length);

        if ($closure) {
            $name = $closure($name);
        }

        return $name.'.'.$extension;
    }
}

if (! function_exists('page_title')) {
    /**
     * Set the page title.
     *
     * @param  string $title
     * @param  string $delimiter
     * @return string
     */
    function page_title(string $title, string $delimiter = '|'): string
    {
        return sprintf('%s %s %s', $title, $delimiter, config('app.name'));
    }
}

if (! function_exists('active_route')) {
    /**
     * Return the "active" class if current route is matched.
     *
     * @param  string|array $route
     * @param  string $output
     * @return string|null
     */
    function active_route($route, $output = 'active'): ?string
    {
        if (is_array($route)) {
            if (call_user_func_array('Route::is', $route)) {
                return $output;
            }
        } else {
            if (Route::is($route)) {
                return $output;
            }
        }
    }
}
