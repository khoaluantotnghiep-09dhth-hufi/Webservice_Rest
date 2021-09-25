<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exchange extends Model
{
      //khai báo bảng table
    protected $table = 'tbl_product_exchange';
    //
    protected $primaryKey='id';

    //
    public $timestamps = false;
}
