<?php

namespace App\Support\Action;

use Illuminate\Contracts\Bus\Dispatcher;

trait DispatchesActions
{
    /**
     * Dispatch an action in the current process.
     *
     * @param  mixed $action
     * @return mixed
     */
    public function execute($action)
    {
        return app(Dispatcher::class)->dispatchNow($action);
    }
}
