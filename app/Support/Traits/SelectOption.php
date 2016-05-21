<?php

namespace App\Support\Traits;

trait SelectOption
{
    /**
     * @var array
     */
    protected $list = [];

    /**
     * Get the list.
     *
     * @return array
     */
    public function get()
    {
        return $this->list;
    }

    /**
     * Create an array with label and value of the option.
     *
     * @param  array $options
     * @param  array|null $default
     * @return $this
     */
    public function makeListOptions(array $options, $default = null)
    {
        $output = is_array($default) ? $default : [];

        $this->list = array_merge($output, $options);

        return $this;
    }

    /**
     * Execute a callback over each item.
     *
     * @param  callable $callback
     * @return $this
     */
    public function each(callable $callback)
    {
        foreach ($this->list as $key => &$item) {
            $item = $callback($item, $key);
        }

        return $this;
    }
}
