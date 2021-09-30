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
                'tbl_product_info.id_color'
            )
            ->orderBy('tbl_product.name')
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
                'tbl_product_info.id_size',
                'tbl_product_info.id_color'
            )
            ->where('tbl_product.id', '=', $id)
            ->orderBy('tbl_product.name')
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
                'tbl_product_info.id_color'
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
                'tbl_product_info.id_color'
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
