<?php

namespace App\Repositories;

use App\Contracts\Repositories\UserRepository as Contract;
use Illuminate\Http\Request;

class UserRepository implements Contract
{
    /** 
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * Class contructor.
     */
    public function __construct()
    {
        $model = config('auth.providers.users.model');
        $this->model = new $model;
    }

    /**
     * Create a new user.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Auth\Authenticatable
     */
    public function create(Request $request)
    {
        return $this->model->create([
            'first_name' => $request->input('first_name'),
            'last_name'  => $request->input('last_name'),
            'email'      => $request->input('email'),
            'password'   => bcrypt($request->input('password')),
        ]);
    }

    /**
     * Update an user.
     * 
     * @param  int $id
     * @param  array $data
     * @return \Illuminate\Contracts\Auth\Authenticatable
     */
    public function update($id, array $data)
    {
        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        $user = $this->model->findOrFail($id);

        return $user->update($data);
    }
}
