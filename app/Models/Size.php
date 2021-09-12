<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    //khai báo bảng table
    protected $table = 'tbl_size';
    //
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'name'
    ];
    //
    public $timestamps = false;

    public function productInfo()
    {
        return $this->hasMany('App\Models\ProductInfo', 'id_size', 'id');
    }
}
