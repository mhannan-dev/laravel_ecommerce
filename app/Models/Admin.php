<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;
    protected $guard = 'admin';
    protected $fillable = [
        'name', 'type', 'mobile', 'email', 'password', 'image', 'status', 'created_at', 'updated_at'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];


}
