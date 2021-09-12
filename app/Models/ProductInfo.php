<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductInfo extends Model
{
    //khai báo bảng table
    protected $table = 'tbl_product_info';
    //
    protected $fillable = [
        'id',
        'quantity',
        'id_product',
        'id_size',
        'id_color'
    ];
    protected $primaryKey = 'id';
    //
    public $timestamps = false;

    public function color()
    {
        return $this->belongsTo('App\Models\Color', 'id')->withDefault([
            'name' => 'Not found Color',
        ]);
    }
    public function size()
    {
        return $this->belongsTo('App\Models\Size', 'id')->withDefault([
            'name' => 'Not found Size',
        ]);
    }
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'id')->withDefault([
            'name' => 'Not found Product',
        ]);
    }
}
