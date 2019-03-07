<?php

namespace App\Support;

use DateTimeZone;
use Illuminate\Support\Str;

class Locale
{
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

    const General = 'General';

    /**
     * Get all the world's continents.
     *
     * @return array
     */
    public static function continents()
    {
        // Todo: support translation

        return [
            static::AFRICA,
            static::ANTARCTICA,
            static::ARCTIC,
            static::ASIA,
            static::ATLANTIC,
            static::AUSTRALIA,
            static::EUROPE,
            static::INDIAN,
            static::PACIFIC,
        ];
    }

    /**
     * Get all the world's timezones.
     *
     * @param  bool $group
     * @return array
     */
    public static function timezones($group = false)
    {
        $output = [];

        $tzlist = DateTimeZone::listIdentifiers(DateTimeZone::ALL);

        foreach ($tzlist as $timezone) {
            if ($group) {
                if (Str::contains($timezone, '/')) {
                    [$continent, $city] = explode('/', $timezone);

                    if (in_array($continent, static::continents())
                        && ! empty($city)) {
                        $output[$continent][$timezone] = str_replace('_', ' ', $city); // Creates array(DateTimeZone => 'Friendly name')
                    }
                } else {
                    $output[static::General][$timezone] = $timezone;
                }
            } else {
                $output[$timezone] = $timezone;
            }
        }

        if ($group) {
            // Move General group to the beginning of the array
            $output = [static::General => $output[static::General]] + $output;
        }

        return $output;
    }
}
