<?php

namespace App\Support;

use InvalidArgumentException;

class Currency
{
    /**
     * @var string
     */
    const FORMAT_CODE = 'code';

    /**
     * @var string
     */
    const FORMAT_SYMBOL = 'symbol';

    /**
     * Get currency by it's 3 letter ISO code.
     *
     * @param  string $currency
     * @param  string $subKey
     * @param  mixed|null $default
     * @return mixed
     */
    public static function get($currency, $subKey = null, $default = null)
    {
        $currency = strtoupper($currency);
        $key = ! is_null($subKey) ? $currency.'.'.$subKey : $currency;

        return array_get(static::all(), $key, $default);
    }

    /**
     * Get all currencies.
     *
     * @return array
     */
    public static function all()
    {
        return require base_path('resources/locales/currencies.php');
    }

    /**
     * Format amount with specific currency.
     *
     * @param  int|float $amount
     * @param  string $code
     * @return string
     */
    public static function format($amount, $code)
    {
        if (! $currency = static::get($code)) {
            throw new InvalidArgumentException("`{$code}` is not supported!");
        }

        return number_format($amount, $currency['decimal_length'], $currency['decimal_point'], $currency['thousands_separator']);
    }

    /**
     * Display formatted currency.
     *
     * @param  int|float $amount
     * @param  string $currency
     * @param  string $format
     * @return string
     */
    public static function display($amount, $currency, $format = 'symbol')
    {
        $amount = static::format($amount, $currency);
        $currency = static::get($currency);
        $format = in_array($format, [static::FORMAT_CODE, static::FORMAT_SYMBOL])
            ? $currency[$format]
            : $currency[static::FORMAT_SYMBOL];

        switch ($currency['position']) {
            case 'before':
            default:
                return sprintf('%s%s', $format, $amount);
                break;

            case 'after':
                return sprintf('%s%s', $amount, $format);
                break;

            case 'before_space':
                return sprintf('%s %s', $format, $amount);
                break;

            case 'after_space':
                return sprintf('%s %s', $amount, $format);
                break;
        }
    }
}
