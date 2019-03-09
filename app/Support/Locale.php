<?php

namespace App\Support;

use Illuminate\Support\Str;
use Illuminate\Support\Traits\Macroable;

class Locale
{
    use Macroable;

    const _GENERAL_ = 'General';
    const AFRICA = 'Africa';
    const AMERICA = 'America';
    const ANTARCTICA = 'Antarctica';
    const ARCTIC = 'Arctic';
    const ASIA = 'Asia';
    const ATLANTIC = 'Atlantic';
    const AUSTRALIA = 'Australia';
    const EUROPE = 'Europe';
    const INDIAN = 'Indian';
    const PACIFIC = 'Pacific';

    /**
     * World's continent names.
     *
     * @var array
     */
    protected static $continents = [
        self::AFRICA,
        self::ANTARCTICA,
        self::ARCTIC,
        self::ASIA,
        self::ATLANTIC,
        self::AUSTRALIA,
        self::EUROPE,
        self::INDIAN,
        self::PACIFIC,
    ];

    /**
     * Custom timezones.
     *
     * @var array
     */
    protected static $customTimezones = [];

    /**
     * Get the world's continents.
     *
     * @return array
     */
    public static function continents()
    {
        static $continents;

        if (isset($continents)) {
            return $continents;
        }

        // Todo: support translation

        return $continents = array_combine(static::$continents, static::$continents);
    }

    /**
     * Get the world's timezones.
     *
     * @param  bool $group
     * @return array
     */
    public static function timezones($group = false)
    {
        if ($group) {
            return static::groupedTimezones();
        }

        static $timezones;

        if (isset($timezones)) {
            return $timezones;
        }

        $tzlist = timezone_identifiers_list();

        return $timezones = array_merge(
            array_combine($tzlist, $tzlist),
            static::$customTimezones
        );
    }

    /**
     * Get all timezones and grouped by continent name.
     *
     * @return array
     */
    public static function groupedTimezones()
    {
        static $timezones;

        if (isset($timezones)) {
            return $timezones;
        }

        foreach (static::timezones() as $timezone) {
            if (Str::contains($timezone, '/')) {
                [$continent, $city] = explode('/', $timezone);

                if (in_array($continent, static::continents())
                    && ! empty($city)) {
                    $timezones[$continent][$timezone] = str_replace('_', ' ', $city); // Creates array(DateTimeZone => 'Friendly name')
                }
            } else {
                $timezones[static::_GENERAL_][$timezone] = $timezone;
            }
        }

        // Move General group to the beginning of the array
        $timezones = [static::_GENERAL_ => $timezones[static::_GENERAL_]] + $timezones;

        return $timezones;
    }

    /**
     * Add new timezone to the list.
     *
     * @param  string $tz
     * @param  string $name
     * @return void
     */
    public static function addTimezone(string $tz, string $name = null)
    {
        static::$customTimezones[$tz] = $name ?: $tz;
    }
}
