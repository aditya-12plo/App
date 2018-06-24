<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orderstatus extends Model
{
       protected $table = 'orderstatus';
    protected $primaryKey = 'id';
    protected $fillable = array('statusdatetime','order', 'status');
    public $timestamps = false;
}
