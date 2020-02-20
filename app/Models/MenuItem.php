<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuItem extends Model{
    use SoftDeletes;

    protected $fillable = ['category_id','item','image','price'];
    protected $dates = ['deleted_at'];

    public function category(){
        return $this->belongsTo('App\Models\MenuCategory');
    }
}
