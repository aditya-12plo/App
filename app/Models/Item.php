<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
       protected $table = 'itemnya';
    protected $primaryKey = 'id';
    protected $fillable = array('sku','name', 'description','price','orders');
    public $timestamps = false;
}
