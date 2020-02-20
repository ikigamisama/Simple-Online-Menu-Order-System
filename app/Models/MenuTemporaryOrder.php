<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuTemporaryOrder extends Model
{
    protected $fillable = ['customer_name','quantity','order_item','price'];
    protected $dates = ['deleted_at'];
}
