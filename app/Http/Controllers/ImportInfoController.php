<?php
//Kiểm tra class thêm vào chưa
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImportInfoController extends Controller
{
    public function index()
    {

        $result = DB::table('tbl_import_info')
            ->join('tbl_product_info', 'tbl_product_info.id', '=', 'tbl_import_info.id_product_info')
            ->join('tbl_order_info', 'tbl_order_info.id', '=', 'tbl_import_info.id_order_info')
            ->join('tbl_size', 'tbl_size.id', '=', 'tbl_product_info.id_size')
            ->join('tbl_color', 'tbl_color.id', '=', 'tbl_product_info.id_color')
            ->join('tbl_product', 'tbl_product.id', '=', 'tbl_product_info.id_product')
            ->join('tbl_order', 'tbl_order.id', '=', 'tbl_order_info.id_order')
            ->select(
                'tbl_import_info.id',
                'tbl_import_info.quantity',
                'tbl_product.name',
                'tbl_product.image',
                'tbl_size.name as nameSize',
                'tbl_color.name as nameColor',
                'tbl_order.date_order',
            )
            ->orderBy('tbl_import_info.id', 'DESC')
            ->get();
        return response()->json($result);
    }

    public function store(Request $request)
    {
        DB::table('tbl_import_info')->insert(
            [
                // Carbon::createFromFormat('d/m/Y', $request->date_order)->format('Y-m-d'),
                "id" => $request->id,
                'id_import' => $request->id_import,
                'id_order_info' => $request->id_order_info,
                'id_product_info' => $request->id_product_info,
                'quantity' => $request->quantity,
            ]
        );
        return response()->json($request);
    }

    public function show($id)
    {
        $result = DB::table('tbl_import_info')
            ->join('tbl_product_info', 'tbl_product_info.id', '=', 'tbl_import_info.id_product_info')
            ->join('tbl_order_info', 'tbl_order_info.id', '=', 'tbl_import_info.id_order_info')
            ->join('tbl_size', 'tbl_size.id', '=', 'tbl_product_info.id_size')
            ->join('tbl_color', 'tbl_color.id', '=', 'tbl_product_info.id_color')
            ->join('tbl_product', 'tbl_product.id', '=', 'tbl_product_info.id_product')
            ->join('tbl_order', 'tbl_order.id', '=', 'tbl_order_info.id_order')
            ->select(
                'tbl_import_info.id',
                'tbl_import_info.quantity',
                'tbl_product.name',
                'tbl_product.image',
                'tbl_size.name as nameSize',
                'tbl_color.name as nameColor',
                'tbl_order.date_order',
            )
            ->where('tbl_import_info.id_import', '=', $id)
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
