<?php

namespace App\Repositories;

use App\Contracts\Repositories\UserRepository as Contract;
use Illuminate\Http\Request;

class UserRepository implements Contract
{
    /**
     * Create a new user.
     * 
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Contracts\Auth\Authenticatable
     */
    public function create(Request $request)
    {
        $model = config('auth.model');

        return (new $model)->create([
            'first_name' => $request->input('first_name'),
            'last_name'  => $request->input('last_name'),
            'email'      => $request->input('email'),
            'password'   => bcrypt($request->input('password')),
        ]);
    }
}
