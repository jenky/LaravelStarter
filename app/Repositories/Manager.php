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
     * @param  array $data
     * @return void
     */
    abstract protected function handle(Request $request, array $data = []);

    /**
     * Set the model.
     *
     * @param  \Illuminate\Database\Eloquent\Model
     * @return $this
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get the model.
     *
     * @param  bool $fresh
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getModel($fresh = false)
    {
        return $fresh ? $this->model->fresh() : $this->model;
    }

    /**
     * Attach the request data too the model.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int|null $id
     * @param  array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function attach(Request $request, $id = null, array $data = [])
    {
        if (is_numeric($id)) {
            $this->model = $this->model->findOrFail($id);
        }

        $this->handle($request, $data);

        return $this->model;
    }
}
