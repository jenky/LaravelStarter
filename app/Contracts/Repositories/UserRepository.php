<?php

namespace App\Contracts\Repositories;

use Illuminate\Http\Request;

interface UserRepository
{
    /**
     * Create a new user.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Auth\Authenticatable
     */
    public function create(Request $request);

    /**
     * Update an user.
     * 
     * @param  int $id
     * @param  array $data
     * @return \Illuminate\Contracts\Auth\Authenticatable
     */
    public function update($id, array $data);
}
