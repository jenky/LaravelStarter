<?php

namespace App\Console;

use Illuminate\Support\Facades\Validator;

trait ValidatesConsoleInput
{
    /**
     * Validates input value.
     *
     * @param  callable $callable
     * @param  string|array $rules
     * @param  array $messages
     * @return mixed
     */
    protected function withValidation(callable $callable, $rules, array $messages = [])
    {
        $input = $callable();

        $mapMessages = static function ($message, $rule) {
            return ["input.$rule" => $message];
        };

        $validator = Validator::make(
            compact('input'),
            ['input' => $rules],
            collect($messages)->mapWithKeys($mapMessages)->toArray()
        );

        if ($validator->fails()) {
            $this->warn($validator->errors()->first());
            $input = $this->withValidation($callable, $rules, $messages);
        }

        return is_string($input) && $input === '' ? null : $input;
    }
}
