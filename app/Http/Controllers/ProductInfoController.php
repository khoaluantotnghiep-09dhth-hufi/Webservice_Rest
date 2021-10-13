<?php
//Kiểm tra class thêm vào chưa
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ProductInfoController extends Controller
{
    public function index()
    {
        $result = DB::table('tbl_product_info')
            ->join('tbl_color', 'tbl_color.id', '=', 'tbl_product_info.id_color')
            ->join('tbl_size', 'tbl_size.id', '=', 'tbl_product_info.id_size')
            ->join('tbl_product', 'tbl_product.id', '=', 'tbl_product_info.id_product')
            ->select(
                'tbl_product_info.id',
                'tbl_product.name',
                'tbl_product_info.quantity',
                'tbl_size.name as nameSize',
                'tbl_color.name as nameColor',
                'tbl_product_info.id_size',
                'tbl_product_info.id_color',
                'tbl_product_info.id_product'
            )
            ->orderBy('tbl_product_info.id', 'DESC')
            ->get();
        return response()->json($result);
    }
    public function index2($id)
    {
        $result = DB::table('tbl_product_info')
            ->join('tbl_color', 'tbl_color.id', '=', 'tbl_product_info.id_color')
            ->join('tbl_size', 'tbl_size.id', '=', 'tbl_product_info.id_size')
            ->join('tbl_product', 'tbl_product.id', '=', 'tbl_product_info.id_product')
            ->select(
                'tbl_product_info.id',
                'tbl_product.name',
                'tbl_product_info.quantity',
                'tbl_size.name as nameSize',
                'tbl_color.name as nameColor',
                'tbl_product.image',
                'tbl_product.price',
                'tbl_product_info.id_size',
                'tbl_product_info.id_color',
                'tbl_product_info.id_product',
                'tbl_product.description',
            )
            ->where('tbl_product.id', '=', $id)
            ->orderBy('tbl_product.name')
            ->get();
        return response()->json($result);
    }
    public function showProductInfoByIdProduct($id)
    {
        $result = DB::table('tbl_product_info')
            ->join('tbl_product', 'tbl_product.id', '=', 'tbl_product_info.id_product')
             //Join table promotion để tính giá khuyến mãi
             ->join('tbl_promotion', 'tbl_promotion.id', '=', 'tbl_product.id_promotion')
            ->select(
                'id_product',
                'tbl_promotion.description as percentSale',
                // 'tbl_product_info.id',
                'tbl_product.image',
                'tbl_product.description',
                'tbl_product.price',
                'tbl_product.name')
            ->where('tbl_product.id', '=', $id)
            ->distinct()->get();
        return response()->json($result);
    }
    public function showProductInfoColorByIdProduct($id)
    {
        $result = DB::table('tbl_product_info')
            ->join('tbl_product', 'tbl_product.id', '=', 'tbl_product_info.id_product')
            ->join('tbl_color', 'tbl_color.id', '=', 'tbl_product_info.id_color')
            ->join('tbl_size', 'tbl_size.id', '=', 'tbl_product_info.id_size')

            ->select(
                'id_product',
                'tbl_product_info.id',
                'tbl_color.id as idColor',
                'tbl_color.name as nameColor',
                'tbl_size.id as idSize',
                'tbl_size.name as nameSize',
                'tbl_product_info.quantity',

            )
            ->where('tbl_product.id', '=', $id)
            ->where('tbl_product_info.quantity', '>', 0)
            ->get();
        return response()->json($result);
    }
    public function index3()
    {
        $result = DB::table('tbl_product_info')

            ->select(DB::raw('sum(quantity) AS countProduct'))
            ->get();
        return response()->json($result);
    }
    public function countStatusProduct()
    {
        $result = DB::table('tbl_product_info')
            ->join('tbl_product', 'tbl_product.id', '=', 'tbl_product_info.id_product')
            ->select(DB::raw('count(quantity) AS countProduct'))
            ->where('tbl_product.status', '=', 1)
            ->get();
        return response()->json($result);
    }
    public function store(Request $request)
    {
        DB::table('tbl_product_info')->insert(
            [
                "id" => $request->id,
                "id_product" => $request->id_product,
                "id_size" => $request->id_size,
                "id_color" => $request->id_color,
                "quantity" => $request->quantity,
            ]
        );
        return response()->json($request);
    }
    public function show($id)
    {
        $result = DB::table('tbl_product_info')
            ->join('tbl_color', 'tbl_color.id', '=', 'tbl_product_info.id_color')
            ->join('tbl_size', 'tbl_size.id', '=', 'tbl_product_info.id_size')
            ->join('tbl_product', 'tbl_product.id', '=', 'tbl_product_info.id_product')
            ->select(
                'tbl_product_info.id',
                'tbl_product.name',
                'tbl_product_info.quantity',
                'tbl_size.name as nameSize',
                'tbl_color.name as nameColor',
                'tbl_product.image',
                'tbl_product_info.id_size',
                'tbl_product_info.id_color',
                'tbl_product_info.id_product'
            )
            ->where('tbl_product_info.id', '=', $id)
            ->orderBy('tbl_product.name')
            ->get();
        return response()->json($result);
    }
    public function show2($id)
    {
        $result = DB::table('tbl_product_info')
            ->join('tbl_order_info', 'tbl_order_info.id_product_info', '=', 'tbl_product_info.id')
            ->join('tbl_color', 'tbl_color.id', '=', 'tbl_product_info.id_color')
            ->join('tbl_size', 'tbl_size.id', '=', 'tbl_product_info.id_size')
            ->join('tbl_product', 'tbl_product.id', '=', 'tbl_product_info.id_product')
            ->select(
                'tbl_product_info.id',
                'tbl_product.name',
                'tbl_product_info.quantity',
                'tbl_size.name as nameSize',
                'tbl_color.name as nameColor',
                'tbl_product.image',
                'tbl_product_info.id_size',
                'tbl_product_info.id_color',
                'tbl_product_info.id_product'
            )
            ->where('tbl_order_info.id', '=', $id)
            ->get();
        return response()->json($result);
    }
    public function update(Request $request)
    {
        DB::table('tbl_product_info')
            ->where('id', $request->idItem)
            ->update(
                [
                    "id_size" => $request->id_size,
                    "id_color" => $request->id_color,
                    "quantity" => $request->quantity,
                ]

            );
        return response()->json($request);
    }
    public function update2(Request $request)
    {
        DB::table('tbl_product_info')
            ->where('id', $request->idItem)
            ->update(
                [
                    "quantity" => $request->quantity,
                ]

            );
        return response()->json($request);
    }
    public function destroy($id)
    {
        DB::table('tbl_product_info')->where('id', '=', $id)->delete();
        return response()->json($id);
    }
}
