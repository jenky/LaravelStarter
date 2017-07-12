<?php

namespace App\Support\Traits;

use Illuminate\Support\Str;
use RuntimeException;

trait TransformerScopes
{
    /**
     * Get all transformer scopes.
     *
     * @return array|null
     */
    public function getTransformerScopes()
    {
        return property_exists($this, 'scopes') ? $this->scopes : null;
    }

    /**
     * Set transformer scopes.
     *
     * @param  string|array $scopes
     * @return $this
     */
    public function setScope($scopes)
    {
        $scopes = is_array($scopes) ? $scopes : func_get_args();

        $this->scopes = $scopes;

        return $this;
    }

    /**
     * Set transformer scopes.
     *
     * @param  string|array $scopes
     * @return $this
     */
    public function scope($scopes)
    {
        return $this->setScope($scopes);
    }

    /**
     * Set transformer scopes.
     *
     * @param  string|array $scopes
     * @return $this
     */
    public function scopes($scopes)
    {
        return $this->setScope($scopes);
    }

    /**
     * Run the transformer scopes.
     *
     * @param  mixed $resource
     * @return mixed
     */
    protected function parseScopes($resource)
    {
        $scopes = $this->getTransformerScopes();
        $class = get_class($resource);

        if (method_exists($this, 'scopeDefault')) {
            $resource = $this->scopeDefault($resource);
        }

        if (is_array($scopes)) {
            foreach ($scopes as $scope) {
                $resource = $this->callTransformerScope($scope, $resource);
            }
        }

        if (! $resource instanceof $class) {
            throw new RuntimeException(sprintf('Invalid return value from scope. Expected %s, received %s.',
                $class,
                is_object($resource) ? get_class($resource) : gettype($resource)));
        }

        return $resource;
    }

    /**
     * Call the scope method.
     *
     * @param  string $scope
     * @param  mixed
     * @return mixed
     */
    protected function callTransformerScope($scope, $resource)
    {
        $method = 'scope'.Str::studly($scope);

        if (method_exists($this, $method)) {
            $resource = $this->{$method}($resource);
        }

        return $resource;
    }
}
