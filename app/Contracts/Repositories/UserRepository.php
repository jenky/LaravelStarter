<?php

namespace App\Contracts\Repositories;

use Illuminate\Http\Request;

interface UserRepository
{
    /**
     * Create a new user.
     * 
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Contracts\Auth\Authenticatable
     */
    public function create(Request $request);
}
