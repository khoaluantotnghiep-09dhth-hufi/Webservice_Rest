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
              
                'tbl_category.name as nameCategory',
                'tbl_product.image',
                'tbl_promotion.name as namePromotion',
                'tbl_promotion.description as percentSale',

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
        $result =  DB::table("tbl_product")
            ->join('tbl_product_info', "tbl_product.id", "=", 'tbl_product_info.id_product')
            ->join('tbl_color', "tbl_color.id", "=", 'tbl_product_info.id_color')
            ->join('tbl_size', "tbl_size.id", "=", 'tbl_product_info.id_size')
            ->where("tbl_product.id", "=", $id)
            ->select("tbl_color.id as id_color", "tbl_color.name as nameColor", "tbl_size.id as id_size", "tbl_size.name as nameSize", DB::raw('sum(tbl_product_info.quantity) as totalQuantityProduct'),)
            ->groupBy("tbl_color.id", "tbl_color.name", "tbl_size.id", "tbl_size.name")
            ->get();
        return response()->json($result);
    }

    public function showCategory($id_Category)
    {
        $result = DB::table('tbl_product')
        ->join('tbl_category', 'tbl_category.id', '=', 'tbl_product.id_category')
        ->join('tbl_promotion', 'tbl_promotion.id', '=', 'tbl_product.id_promotion')
        ->where('tbl_category.id','=',$id_Category)
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
            'tbl_promotion.description as percentSale',

        )->orderBy('tbl_product.id')
        ->get();
    return response()->json($result);
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
