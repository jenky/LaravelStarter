<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\Controller as BaseController;
use Illuminate\Http\Request;
use Jenky\LaravelAPI\Exception\ErrorException;

class Controller extends BaseController
{
    /**
     * {@inheritdoc}
     */
    protected function buildFailedValidationResponse(Request $request, array $errors)
    {
        $output = [];

        foreach ($errors as $field => $message) {
            $output[] = [
                'field' => $field,
                'message' => isset($message[0]) ? $message[0] : '',
            ];
        }

        throw new ErrorException($output, 'The given data failed to pass validation.');
    }
}
