<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuOrder extends Model
{
    protected $fillable = ['customer_name','order_items','order_coupon','tax_price','total_price'];
    protected $dates = ['deleted_at'];
}
