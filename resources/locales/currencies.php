<?php

return [

    /*
     * @var array
     * @param code string
     * @param name string
     * @param symbol string
     * @param string thousands_separator
     * @param string decimal_point
     * @param int decimal_length
     * @param string format
     */

    'USD' => [
        'code' => 'USD',
        'name' => 'U.S Dollar',
        'symbol' => '$',
        'thousands_separator' => ',',
        'decimal_point' => '.',
        'decimal_length' => 2,
        'format' => '{symbol}{value}',
    ],

    'VND' => [
        'code' => 'VND',
        'name' => 'Vietnam Dong',
        'symbol' => 'đ',
        'thousands_separator' => '.',
        'decimal_point' => '.',
        'decimal_length' => 0,
        'format' => '{value} {symbol}',
    ],

];
