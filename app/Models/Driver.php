<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Notifications\PialangsResetPasswordNotification;

class Driver extends Authenticatable
{
   use Notifiable;
	
		protected $table = 'driver';
    protected $primaryKey = 'id';
    protected $fillable = ['username', 'password','orders'];

    protected $hidden = [
        'password', 'remember_token',
    ];
	public $timestamps = false;

}
