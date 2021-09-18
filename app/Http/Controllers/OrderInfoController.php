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
                'tbl_order_info.retail_price',
                'tbl_product.name as nameProduct',
                'tbl_product.image',
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
                'retail_price' => $request->retail_price,
            ]
        );
        return response()->json($request);
    }

    public function show(Request $request)
    {
        $result = DB::table('tbl_order_info')
            ->join('tbl_product_info', 'tbl_product_info.id', '=', 'tbl_order_info.id_product_info')
            ->join('tbl_order', 'tbl_order.id', '=', 'tbl_order_info.id_order')
            ->join('tbl_size', 'tbl_size.id', '=', 'tbl_product_info.id_size')
            ->join('tbl_color', 'tbl_color.id', '=', 'tbl_product_info.id_color')
            ->join('tbl_product', 'tbl_product.id', '=', 'tbl_product_info.id_product')
            ->where('tbl_order_info.id_order', '=', $request->id)
            ->select(
                'tbl_order_info.id',
                'tbl_order_info.quantity',
                'tbl_size.name as nameSize',
                'tbl_color.name as nameColor',
                'tbl_order_info.retail_price',
                'tbl_product.name as nameProduct',
                'tbl_product.image',
            )
            ->get();
        return response()->json($result);
    }
    //Cập nhật một Product theo $id
    public function update(Request $request)
    {
        //     DB::table('tbl_order')
        //     ->where('id', $request->id)
        //     ->update(
        //         [
        //             'date_order' => $request->date_order,
        //             'name_warehouse' => $request->name_warehouse,
        //             'status' => $request->status,
        //         ]

        //     );
        // return response()->json($request);
    }
    //Xóa một Product theo $id
    public function destroy($id)
    {
        // DB::table('tbl_order')->where('id', '=', $id)->delete();
        // return response()->json($id);
    }
}