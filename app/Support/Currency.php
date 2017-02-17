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
     * @param  array $options
     * @return string
     */
    public static function format($amount, $code, array $options = [])
    {
        if (! $currency = static::get($code)) {
            throw new InvalidArgumentException("`{$code}` is not supported!");
        }

        $currency = array_merge($currency, $options);

        return number_format($amount, $currency['decimal_length'], $currency['decimal_point'], $currency['thousands_separator']);
    }

    /**
     * Display formatted currency.
     *
     * @param  int|float $amount
     * @param  string $currency
     * @param  array $options
     * @return string
     */
    public static function display($amount, $currency, array $options = [])
    {
        $amount = static::format($amount, $currency, $options);
        $currency = array_merge(static::get($currency), $options);
        $format = array_get($currency, 'format', '{value} {code}');
        $replaces = [
            '{value}' => $amount,
            '{code}' => array_get($currency, 'code'),
            '{symbol}' => array_get($currency, 'symbol'),
        ];

        return str_replace(array_keys($replaces), array_values($replaces), $format);
    }
}
