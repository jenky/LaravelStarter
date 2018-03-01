<?php

namespace App\Models\Traits;

trait CastPresenter
{
    /**
     * {@inheritdoc}
     */
    public function getAttribute($key)
    {
        $value = optional($this->present())->{$key};

        return $value ?: parent::getAttribute($key);
    }
}
