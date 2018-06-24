<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
       protected $table = 'statusnya';
    protected $primaryKey = 'id';
    protected $fillable = array('code','description', 'orderstatuses','orderdrivers');
    public $timestamps = false;
}
