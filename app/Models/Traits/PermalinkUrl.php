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
    public function scopeSlug($query, $slug, $key = null)
    {
        return $query->where(
            $key ?: $this->getSlugKey(), '=', $slug
        );
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

        return $this->scopeSlug($query, $value, $key)->first();
    }

    /**
     * Find resource by slug or id and throws
     * exception if the result is empty.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  string|int $value
     * @param  string|null $key
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function scopeFindBySlugOrFail($query, $value, $key = null)
    {
        if (is_numeric($value)) {
            return $this->findOrFail($value);
        }

        return $this->scopeSlug($query, $value, $key)->firstOrFail();
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
    public function generateUrl($route, $method = 'route')
    {
        $id = $this->{$this->getSlugKey()} ?? $this->getKey();

        return $method($route, [$id]);
    }
}
