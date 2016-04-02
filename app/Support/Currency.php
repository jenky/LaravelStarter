<?php

namespace App\Support;

class Currency
{
    /**
     * @var array
     */
    public static $currencies = [
        'USD' => [
            'code'                => 'USD',
            'name'                => 'U.S Dollar',
            'symbol'              => '$',
            'thousands_separator' => ',',
            'decimal_point'       => '.',
            'decimal_length'      => 2,
        ],
        'VND' => [
            'code'                => 'VND',
            'name'                => 'Vietnam Dong',
            'symbol'              => 'đ',
            'thousands_separator' => ' ',
            'decimal_point'       => '.',
            'decimal_length'      => 0,
        ],
    ];

    /**
     * Get currency by it's 3 letter ISO code.
     *
     * @param  string $currency
     * @param  string $subKey
     * @param  mixed|null $default
     * @return mixed
     */
    public static function getCurrency($currency, $subKey = null, $default = null)
    {
        $currency = strtoupper($currency);
        $key = ! is_null($subKey) ? $currency.'.'.$subKey : $currency;

        return array_get(static::$currencies, $key, $default);
    }

    /**
     * Add a new currency.
     *
     * @param  array $currency
     * @return void
     */
    public static function addCurrency(array $currency)
    {
        if (! isset($currency['name'])) {
            return;
        }

        static::$currencies[$currency['name']] = $currency;
    }

    /**
     * Format amount with specific currency.
     *
     * @param  int|float $amount
     * @param  string $currency
     * @return string
     */
    public static function format($amount, $currency)
    {
        if (! $currency = static::getCurrency($currency)) {
            throw new InvalidArgumentException("`{$currency}` is not supported!");
        }

        return number_format($amount, $currency['decimal_length'], $currency['decimal_point'], $currency['thousands_separator']);
    }
}
