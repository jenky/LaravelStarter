<?php

namespace App\Support;

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
     * @var array
     * @param code string
     * @param name string
     * @param symbol string
     * @param string thousands_separator
     * @param string decimal_point
     * @param int decimal_length
     * @param string position: before, after, before_space, after_space
     */
    public static $currencies = [
        'USD' => [
            'code'                => 'USD',
            'name'                => 'U.S Dollar',
            'symbol'              => '$',
            'thousands_separator' => ',',
            'decimal_point'       => '.',
            'decimal_length'      => 2,
            'position'            => 'before',
        ],
        'VND' => [
            'code'                => 'VND',
            'name'                => 'Vietnam Dong',
            'symbol'              => 'đ',
            'thousands_separator' => '.',
            'decimal_point'       => '.',
            'decimal_length'      => 0,
            'position'            => 'after_space',
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
        $currency = static::getCurrency($currency);
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
