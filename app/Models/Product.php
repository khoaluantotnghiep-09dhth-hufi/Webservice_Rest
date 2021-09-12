<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    //khai báo bảng table
    protected $table = 'tbl_product';
    //
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'name',
        'price',
        'description',
        'like_product',
        'dislike_product',
        'id_category',
        'image',
        'id_promotion'
    ];
    //
    public $timestamps = false;

    public function productInfo()
    {
        return $this->hasMany('App\Models\ProductInfo', 'id_product', 'id');
    }
}
