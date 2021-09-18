<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductForCategoryController extends Controller
{
    //Lấy tất cả danh sách Product

    public function index()
    {
        $result = DB::table('tbl_product')
            ->join('tbl_category', 'tbl_category.id', '=', 'tbl_product.id_category')
            ->join('tbl_promotion', 'tbl_promotion.id', '=', 'tbl_product.id_promotion')

            ->select(
                'tbl_product.id',
                'tbl_product.name',
                'tbl_product.price',
                'tbl_product.description',
                'tbl_product.like_product',
                'tbl_product.dislike_product',
                'tbl_category.name as nameCategory',
                'tbl_product.image',
                'tbl_promotion.name as namePromotion',
                'tbl_promotion.desciption as percentSale',

            )->orderBy('tbl_product.id')
            ->get();
        return response()->json($result);
    }
    //Tạo một Product
    public function store(Request $request)
    {
        DB::table('tbl_product')->insert(
            [
                "id" => $request->id,
                "name" => $request->nameColor,
            ]
        );
        return response()->json($request);
    }
    //Lấy một Product theo $id
    public function show($id)
    {
    }
    //Cập nhật một Product theo $id
    public function update($id)
    {
    }
    //Xóa một Product theo $id
    public function destroy($id)
    {
    }
}
