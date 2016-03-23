<?php

namespace App\Repositories;

use Illuminate\Http\Request;

abstract class Manager
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * Handle the request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return void
     */
    abstract protected function handle(Request $request);

    /**
     * Set the model.
     *
     * @param  \Illuminate\Database\Eloquent\Model
     * @return mixed
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get the model.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Attach the request data too the model.
     *
     * @param  Request $request
     * @param  int|null $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function attach(Request $request, $id = null)
    {
        if (is_numeric($id)) {
            $this->model = $this->model->findOrFail($id);
        }

        $this->handle($request);

        return $this->model;
    }
}
