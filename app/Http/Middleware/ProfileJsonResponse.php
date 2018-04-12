<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;

class ProfileJsonResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if (! app()->bound('debugbar')) {
            return $response;
        }

        $debugbar = app('debugbar');

        if ($request->has('_debugbar') &&
            $debugbar->isEnabled() &&
            $response instanceof JsonResponse &&
            is_object($response->getData())
        ) {
            $response->setData($response->getData(true) + [
                '_debugbar' => $debugbar->getData(),
            ]);
        }

        return $response;
    }
}
