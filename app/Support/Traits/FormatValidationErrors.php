<?php

namespace App\Support\Traits;

use Illuminate\Contracts\Validation\Validator;
use Jenky\LaravelAPI\Exception\ErrorException;

trait FormatValidationErrors
{
    /**
     * Format the errors from the given Validator instance.
     *
     * @param  \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     */
    protected function formatValidationErrors(Validator $validator)
    {
        return $this->formatAndThrowsException($validator);
    }

    /**
     * Format the errors from the given Validator instance.
     *
     * @param  \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     */
    protected function formatErrors(Validator $validator)
    {
        return $this->formatAndThrowsException($validator);
    }

    /**
     * Format the errors from the given Validator instance.
     *
     * @param  \Illuminate\Contracts\Validation\Validator $validator
     * @throws \Jenky\LaravelAPI\Exception\ErrorException
     */
    protected function formatAndThrowsException(Validator $validator)
    {
        $output = [];

        foreach ($validator->errors()->messages() as $field => $message) {
            $output[] = [
                'field' => $field,
                'message' => isset($message[0]) ? $message[0] : '',
            ];
        }

        throw new ErrorException($output, 'The given data failed to pass validation.');
    }
}
