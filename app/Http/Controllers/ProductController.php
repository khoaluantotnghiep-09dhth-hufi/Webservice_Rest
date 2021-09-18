<?php
//Kiểm tra class thêm vào chưa
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //Lấy tất cả danh sách Product
    public function index()
    {

        $result = DB::table('tbl_product as product')
            ->join('tbl_category as c', 'pp.id', '=', 'product.id_category')
            ->join('tbl_promotion as pp', 'pp.id', '=', 'product.id_promotion')
            ->join('tbl_product_info as ppf', 'ppf.id_product', '=', 'product.id')
            ->select('product.id',
                'product.name_product',
                'product.price',
                'product.description',
                'product.like_product',
                'product.id_category  ',

                'c.name', 'product.image',
                'product.id_promotion',
                'pp.name', 'pp.date_start',
                'pp.date_end',
                'pp.desciption',
                'ppf.id',
                'ppf.id_size',
                'ppf.id_color',
                'ppf.quantity as quanityAll')->orderBy('product.id')
            ->get();
        return response()->json($result);
    }
    public function index2()
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
                'tbl_product.dislike_product',
                'tbl_category.name as nameCategory',
                'tbl_product.image',
                'tbl_promotion.name as namePromotion',
                'tbl_promotion.desciption as percentSale',
                'tbl_product_info.quantity as quantityAllProduct',
                'tbl_size.name as nameSize',
                'tbl_color.name as nameColor'
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
            'tbl_product.dislike_product',
            'tbl_category.name as nameCategory',
            'tbl_product.image',
            'tbl_promotion.name as namePromotion',
            'tbl_promotion.desciption as percentSale',
            'tbl_product_info.quantity as quantityAllProduct',
            'tbl_size.name as nameSize',
            'tbl_color.name as nameColor'
        )
        ->where('tbl_product.id','=',$id)
        ->orderBy('tbl_product.id')
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
