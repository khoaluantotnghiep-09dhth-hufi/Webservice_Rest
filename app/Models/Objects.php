<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Objects extends Model
{
    //khai báo bảng table
    protected $table = 'tbl_object';
    //

    //
    public $timestamps = false;

    // public function category()
    // {
    //     return $this->hasManyThrough('App\Models\Category','App\Models\Sector'
    // ,'id_object','id_sectors','id'
    // );
    // }

    public function sector()
    {
        return $this->hasMany('App\Models\Sector', 'id_object', 'id');
    }
}
