<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'created_at', 'updated_at',
    ];

    /**
     * Validaction rules.
     *
     * @var array
     */
    public static $rules = [
        'first_name' => 'required|min:2',
        'last_name'  => 'required|min:2',
        'email'      => 'required|email',
        'password'   => 'required|min:6',
    ];
}
