<?php

namespace App\Support;

use DateTimeZone;

class Locale
{
    /**
     * Friendly day.
     *
     * @var array
     */
    public static $days = [
        'Sunday',
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday',
        'Saturday',
    ];

    /**
     * Get country by it's 2 letter code.
     *
     * @param  string $code
     * @param  string|null $subKey
     * @param  mixed|null $default
     * @return mixed
     */
    public static function country($code, $subKey = null, $default = null)
    {
        $code = strtoupper($code);
        $key = ! is_null($subKey) ? $code.'.'.$subKey : $code;

        return array_get(static::countries(), $key, $default);
    }

    /**
     * Get all countries.
     *
     * @return array
     */
    public static function countries()
    {
        return require base_path('resources/locales/countries.php');
    }

    /**
     * Get timezone list.
     *
     * @param  bool $group
     * @return array
     */
    public static function getTimezones($group = false)
    {
        $output = [];

        $tzlist = DateTimeZone::listIdentifiers(DateTimeZone::ALL);

        foreach ($tzlist as $timezone) {
            if ($group) {
                $zone = explode('/', $timezone); // 0 => Continent, 1 => City

                // Only use "friendly" continent names
                $continents = [
                    'Africa', 'America', 'Antarctica',
                    'Arctic', 'Asia', 'Atlantic', 'Australia',
                    'Europe', 'Indian', 'Pacific',
                ];

                if (in_array($zone[0], $continents)) {
                    if (isset($zone[1]) != '') {
                        $output[$zone[0]][$zone[0].'/'.$zone[1]] = str_replace('_', ' ', $zone[1]); // Creates array(DateTimeZone => 'Friendly name')
                    }
                }
            } else {
                $output[$timezone] = $timezone;
            }
        }

        return $output;
    }
}
