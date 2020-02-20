<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuCategory extends Model{
    use SoftDeletes;

    protected $fillable = ['category','image'];
    protected $dates = ['deleted_at'];

    public function items(){
        return $this->hasMany('App\Models\MenuItem');
    }
}
