<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
      //khai báo bảng table
    protected $table = 'tbl_sectors';
    //

    //
    public $timestamps = false;

    public function object(){
        return $this->belongsTo('App\Models\Objects','id');
    }
    public function category(){
        return $this->hasMany('App\Models\Category','id_sectors','id');
    }
}
