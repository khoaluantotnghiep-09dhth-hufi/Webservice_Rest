<?php
//Kiểm tra class thêm vào chưa
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductAdminController extends Controller
{
    //Lấy tất cả danh sách Product
    public function index()
    {
        $total = 8;
        $result = DB::table('tbl_product')
            ->join('tbl_category', 'tbl_category.id', '=', 'tbl_product.id_category')
            ->join('tbl_promotion', 'tbl_promotion.id', '=', 'tbl_product.id_promotion')
            ->select(
                'tbl_product.id',
                'tbl_product.id_category',
                'tbl_product.id_promotion',
                'tbl_product.name',
                'tbl_product.price',
                'tbl_product.description',
                'tbl_product.like_product',
                'tbl_category.name as nameCategory',
                'tbl_promotion.description as percentSale',
                'tbl_product.image',
                'tbl_promotion.name as namePromotion',
                'tbl_product.status'
            )
            ->offset(0)
            ->limit(10)
            ->distinct('tbl_product.id')
            ->orderBy('tbl_product.id', 'DESC')
            ->get();
        return response()->json($result);
    }
    //Tạo một Product
    public function store(Request $request)
    {
        DB::table('tbl_product')->insert(
            [
                "id" => $request->id,
                "name" => $request->name,
                "price" => $request->price,
                "description" => $request->description,
                "like_product" => "0",
                "id_category" => $request->id_category,
                "image" => $request->image,
                "id_promotion" => $request->id_promotion,
                'status' => $request->status,
            ]
        );
        return response()->json($request);
    }
    //Lấy một Product theo $id
    public function show($id)
    {
        $result = DB::table('tbl_product')
            ->join('tbl_category', 'tbl_category.id', '=', 'tbl_product.id_category')
            ->join('tbl_product_info', 'tbl_product_info.id_product', '=', 'tbl_product.id')
            ->join('tbl_promotion', 'tbl_promotion.id', '=', 'tbl_product.id_promotion')
            ->join('tbl_color', 'tbl_color.id', '=', 'tbl_product_info.id_color')
            ->join('tbl_size', 'tbl_size.id', '=', 'tbl_product_info.id_size')
            ->select(
                'tbl_product.id',
                'tbl_product.name',
                'tbl_product.price',
                'tbl_product.description',
                'tbl_product.like_product',
                'tbl_category.name as nameCategory',
                'tbl_product.image',
                'tbl_product.id_promotion',
                'tbl_product.id_category',
                'tbl_promotion.name as namePromotion',
                'tbl_promotion.description as percentSale',
                'tbl_product_info.quantity as quantityAllProduct',
                'tbl_size.name as nameSize',
                'tbl_color.name as nameColor',
                'tbl_product.status'
            )
            ->where('tbl_product.id', '=', $id)
            ->orderBy('tbl_product.id')
            ->get();
        return response()->json($result);
    }
    public function showByIdCategory($id)
    {
        $result = DB::table('tbl_product')
            ->join('tbl_category', 'tbl_category.id', '=', 'tbl_product.id_category')
            ->join('tbl_promotion', 'tbl_promotion.id', '=', 'tbl_product.id_promotion')
            ->select(

                'tbl_product.id',
                'tbl_product.id_category',
                'tbl_product.id_promotion',
                'tbl_product.name',
                'tbl_product.price',
                'tbl_product.description',
                'tbl_product.like_product',
                'tbl_category.name as nameCategory',
                'tbl_product.image',
                'tbl_promotion.name as namePromotion',
                'tbl_product.status'
            )
            ->where('tbl_category.id', '=', $id)
            ->distinct('tbl_product.id')
            ->orderBy('tbl_product.id', 'DESC')
            ->get();
        return response()->json($result);
    }
    public function update(Request $request)
    {
        DB::table('tbl_product')
            ->where('id', $request->idItem)
            ->update(
                [
                    "name" => $request->name,
                    "price" => $request->price,
                    "description" => $request->description,
                    "id_category" => $request->id_category,
                    "image" => $request->image,
                    "id_promotion" => $request->id_promotion,
                    'status' => $request->status,
                ]

            );
        return response()->json($request);
    }
    //Xóa một Product theo $id
    public function destroy($id)
    {
        DB::table('tbl_product')->where('id', '=', $id)->delete();
        return response()->json($id);
    }
}
