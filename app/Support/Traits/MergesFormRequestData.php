<?php

namespace App\Support\Traits;

use Illuminate\Support\Str;

trait MergesFormRequestData
{
    use ConditionallyMergesData;

    /**
     * Checks if the request method is of specified type.
     *
     * @param  dynamic  $methods
     * @return bool
     */
    public function methodIs(...$methods)
    {
        foreach ($methods as $method) {
            return $this->isMethod($method);
        }

        return false;
    }

    /**
     * Determine if the current controller action matches a pattern.
     *
     * @param  dynamic  $patterns
     * @return bool
     */
    public function actionIs(...$patterns)
    {
        foreach ($patterns as $pattern) {
            if (Str::is($pattern, $this->route()->getActionName())) {
                return true;
            }
        }

        return false;
    }

    /**
     * Retrieve a value based on a given condition.
     *
     * @param  mixed  $condition
     * @param  mixed  $value
     * @param  mixed  $default
     * @return \Illuminate\Http\Resources\MissingValue|mixed
     */
    public function whenMethodIs($condition, $value, $default = null)
    {
        return $this->when($this->methodIs($condition), $value, $default);
    }

    /**
     * Retrieve a value based on a given condition.
     *
     * @param  mixed  $condition
     * @param  mixed  $value
     * @param  mixed  $default
     * @return \Illuminate\Http\Resources\MissingValue|mixed
     */
    public function whenUrlIs($condition, $value, $default = null)
    {
        return $this->when($this->is($condition), $value, $default);
    }

    /**
     * Retrieve a value based on a given condition.
     *
     * @param  mixed  $condition
     * @param  mixed  $value
     * @param  mixed  $default
     * @return \Illuminate\Http\Resources\MissingValue|mixed
     */
    public function whenFullUrlIs($condition, $value, $default = null)
    {
        return $this->when($this->fullUrlIs($condition), $value, $default);
    }

    /**
     * Retrieve a value based on a given condition.
     *
     * @param  mixed  $condition
     * @param  mixed  $value
     * @param  mixed  $default
     * @return \Illuminate\Http\Resources\MissingValue|mixed
     */
    public function whenRouteIs($condition, $value, $default = null)
    {
        return $this->when($this->routeIs($condition), $value, $default);
    }

    /**
     * Retrieve a value based on a given condition.
     *
     * @param  mixed  $condition
     * @param  mixed  $value
     * @param  mixed  $default
     * @return \Illuminate\Http\Resources\MissingValue|mixed
     */
    public function whenActionIs($condition, $value, $default = null)
    {
        return $this->when($this->actionIs($condition), $value, $default);
    }
}
