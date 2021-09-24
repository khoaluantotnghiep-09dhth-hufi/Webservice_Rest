<?php
//Kiểm tra class thêm vào chưa
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderInfoController extends Controller
{
    public function index()
    {

        $result = DB::table('tbl_order_info')
            ->join('tbl_product_info', 'tbl_product_info.id', '=', 'tbl_order_info.id_product_info')
            ->join('tbl_order', 'tbl_order.id', '=', 'tbl_order_info.id_order')
            ->join('tbl_size', 'tbl_size.id', '=', 'tbl_product_info.id_size')
            ->join('tbl_color', 'tbl_color.id', '=', 'tbl_product_info.id_color')
            ->join('tbl_product', 'tbl_product.id', '=', 'tbl_product_info.id_product')
            ->select(
                'tbl_order_info.id',
                'tbl_order_info.quantity',
                'tbl_size.name as nameSize',
                'tbl_color.name as nameColor',
                'tbl_product.name as nameProduct',
                'tbl_product.image',
                'tbl_order.status'
            )
            ->get();
        return response()->json($result);
    }
    public function index2()
    {

        $result = DB::table('tbl_order_info')
            ->join('tbl_product_info', 'tbl_product_info.id', '=', 'tbl_order_info.id_product_info')
            ->join('tbl_order', 'tbl_order.id', '=', 'tbl_order_info.id_order')
            ->join('tbl_size', 'tbl_size.id', '=', 'tbl_product_info.id_size')
            ->join('tbl_color', 'tbl_color.id', '=', 'tbl_product_info.id_color')
            ->join('tbl_product', 'tbl_product.id', '=', 'tbl_product_info.id_product')
            ->where('tbl_order.status', '=', 0)
            ->select(
                'tbl_order_info.id',
                'tbl_order_info.quantity',
                'tbl_size.name as nameSize',
                'tbl_color.name as nameColor',
                'tbl_product.name as nameProduct',
                'tbl_product.image',
                'tbl_order.status'
            )
            ->get();
        return response()->json($result);
    }

    public function store(Request $request)
    {
        DB::table('tbl_order_info')->insert(
            [
                // Carbon::createFromFormat('d/m/Y', $request->date_order)->format('Y-m-d'),
                "id" => $request->id,
                'id_order' => $request->id_order,
                'id_product_info' => $request->id_product_info,
                'quantity' => $request->quantity,
                'status' => '0'
            ]
        );
        return response()->json($request);
    }

    public function show($id)
    {
        $result = DB::table('tbl_order_info')
            ->join('tbl_product_info', 'tbl_product_info.id', '=', 'tbl_order_info.id_product_info')
            ->join('tbl_order', 'tbl_order.id', '=', 'tbl_order_info.id_order')
            ->join('tbl_size', 'tbl_size.id', '=', 'tbl_product_info.id_size')
            ->join('tbl_color', 'tbl_color.id', '=', 'tbl_product_info.id_color')
            ->join('tbl_product', 'tbl_product.id', '=', 'tbl_product_info.id_product')
            ->select(
                'tbl_order_info.id',
                'tbl_order_info.quantity',
                'tbl_size.name as nameSize',
                'tbl_color.name as nameColor',
                'tbl_product.name as nameProduct',
                'tbl_product.image',
                'tbl_order.status',
            )
            ->where('tbl_order_info.id_order', '=', $id)
            ->get();
        return response()->json($result);
    }
    public function show2($id)
    {
        $result = DB::table('tbl_order_info')
            ->join('tbl_product_info', 'tbl_product_info.id', '=', 'tbl_order_info.id_product_info')
            ->join('tbl_order', 'tbl_order.id', '=', 'tbl_order_info.id_order')
            ->join('tbl_size', 'tbl_size.id', '=', 'tbl_product_info.id_size')
            ->join('tbl_color', 'tbl_color.id', '=', 'tbl_product_info.id_color')
            ->join('tbl_product', 'tbl_product.id', '=', 'tbl_product_info.id_product')
            ->join('tbl_import', 'tbl_import.id_order', '=', 'tbl_order.id')
            ->select(
                'tbl_order_info.id',
                'tbl_order_info.quantity',
                'tbl_order_info.id_product_info',
                'tbl_product.name',
                'tbl_size.name as nameSize',
                'tbl_color.name as nameColor'
            )
            ->where('tbl_order_info.id_order', '=', $id)
            ->where('tbl_order_info.status','=', 0)
            ->get();
        return response()->json($result);
    }
    public function show3($id)
    {
        $result = DB::table('tbl_order_info')
            ->select(
              'tbl_order_info.quantity',
            )
            ->where('tbl_order_info.id', '=', $id)
            ->get();
        return response()->json($result);
    }
    //Cập nhật một Product theo $id
    public function update(Request $request)
    {
            DB::table('tbl_order_info')
            ->where('id', $request->id)
            ->update(
                [
                'id_product_info' => $request->id_product_info,
                'quantity' => $request->quantity,
                ]
            );
        return response()->json($request);
    }
    //Xóa một Product theo $id
    public function destroy($id)
    {
        DB::table('tbl_order_info')->where('id', '=', $id)->delete();
        return response()->json($id);
    }
}
