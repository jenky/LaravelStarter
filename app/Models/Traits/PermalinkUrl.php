<?php

namespace App\Models\Traits;

trait PermalinkUrl
{
    /**
     * Get slug key name.
     *
     * @return string
     */
    protected function getSlugKey()
    {
        return property_exists($this, 'slugKey') ? $this->slugKey : 'slug';
    }

    /**
     * Find resource by slug.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string $slug
     * @param  string|null $key
     * @return \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeBySlug($query, $slug, $key = null)
    {
        $key = $key ?: $this->getSlugKey();

        return $query->where($key, '=', $slug);
    }

    /**
     * Find resource by slug or id.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string|int $value
     * @param  string|null $key
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function scopeFindBySlug($query, $value, $key = null)
    {
        if (is_numeric($value)) {
            return $this->find($value);
        }

        return $this->scopeBySlug($query, $slug, $key)->first();
    }

    /**
     * Find resource by slug or id and throws
     * exception if the result is empty.
     *
     * @param  string|int $value
     * @param  string|null $key
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function scopeFindBySlugOrFail($value, $key = null)
    {
        if (is_numeric($value)) {
            return $this->findOrFail($value);
        }

        return $this->scopeBySlug($query, $slug, $key)->firstOrFail();
    }

    /**
     * Generate url by slug or id.
     *
     * @param  string $route
     * @param  int $id
     * @param  string|null $slug
     * @param  string $method
     * @return string
     */
    public function generateUrl($route, $id, $slug = null, $method = 'route')
    {
        return $method($route, [$slug ?: intval($id)]);
    }

    /**
     * Generate url from eloquent model.
     *
     * @param  string $route
     * @param  string $method
     * @return string
     */
    public function getUrl($route, $method = 'route')
    {
        $id = method_exists($this, 'getKey') ? $this->getKey() : 0;

        return $this->generateUrl($route, $id, $this->{$this->getSlugKey()}, $method);
    }
}
