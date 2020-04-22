<?php

namespace App\Support;

use Illuminate\Support\Str;

class Timezone
{
    const GENERAL = 'General';

    /**
     * Custom timezones.
     *
     * @var array
     */
    protected static $customTimezones = [];

    /**
     * Get the world's timezones.
     *
     * @param  bool $group
     * @return array
     */
    public static function all($group = false): array
    {
        if ($group) {
            return static::grouped();
        }

        $tzlist = timezone_identifiers_list();

        return array_merge(
            array_combine($tzlist, $tzlist),
            static::$customTimezones
        );
    }

    /**
     * Get all timezones and grouped by continent name.
     *
     * @return array
     */
    public static function grouped(): array
    {
        static $timezones;

        if (isset($timezones)) {
            return $timezones;
        }

        foreach (static::all() as $timezone) {
            if (Str::contains($timezone, '/')) {
                [$continent, $city] = explode('/', $timezone);

                if (in_array($continent, Continent::getValues()) && ! empty($city)) {
                    $timezones[$continent][$timezone] = str_replace('_', ' ', $city); // Creates array(DateTimeZone => 'Friendly name')
                }
            } else {
                $timezones[static::GENERAL][$timezone] = $timezone;
            }
        }

        // Move General group to the beginning of the array
        $timezones = [static::GENERAL => $timezones[static::GENERAL]] + $timezones;

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
