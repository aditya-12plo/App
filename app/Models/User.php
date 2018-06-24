<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable;

	protected $table = 'user';
    protected $primaryKey = 'id';
    protected $fillable = ['username', 'password','orders'];

    protected $hidden = [
        'password', 'remember_token',
    ];
	
public $timestamps = false;
}
