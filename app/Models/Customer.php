<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
      //khai báo bảng table
    protected $table = 'tbl_customer';
    //
    protected $primaryKey='id';

    //
    public $timestamps = false;
}
