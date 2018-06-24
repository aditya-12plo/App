<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
       protected $table = 'ordernya';
    protected $primaryKey = 'id';
    protected $fillable = array('address','item', 'user','driver','orderstatus');
    public $timestamps = false;
}
