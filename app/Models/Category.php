<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //khai báo bảng table
    protected $table = 'tbl_category';
    //

    //
    public $timestamps = false;

    public function sector(){
        return $this->belongsTo('App\Models\Sector','id');
    }


}
