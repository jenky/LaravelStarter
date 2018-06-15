<?php

namespace App\Support\Action;

use Illuminate\Contracts\Bus\Dispatcher;

trait Executable
{
    /**
     * Dispatch the action with the given arguments.
     *
     * @return mixed
     */
    public static function execute()
    {
        return app(Dispatcher::class)->dispatchNow(new static(...func_get_args()));
    }
}
