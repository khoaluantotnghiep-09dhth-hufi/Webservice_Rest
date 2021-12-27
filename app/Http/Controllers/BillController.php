<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillController extends Controller
{
    //Lấy tất cả danh sách Bill
    public function index()
    {
        $result = DB::table('tbl_bill')->select('*')->get();
        return response()->json($result);
    }
    public function index2()
    {
        $result = DB::table('tbl_bill')
            ->select('*')
            ->get();
        return response()->json($result);
    }
    public function index3()
    {
        $result = DB::table('tbl_bill')->select(
            DB::raw("(sum(total)) as sumTotal"),
            DB::raw("order_date")
        )
            ->orderBy('order_date')
            ->groupBy(DB::raw("order_date"))
            ->get();

        return response()->json($result);
    }
    public function index4()
    {
        $result = DB::table('tbl_bill')
            ->select(
                DB::raw("(sum(total_quantity)) as sumTotalQuantity"),
                DB::raw("order_date")
            )
            ->orderBy('order_date')
            ->groupBy(DB::raw("order_date"))
            ->get();
        return response()->json($result);
    }
    public function countStatus0Bill()
    {
        $result = DB::table('tbl_bill')
            ->select(
                DB::raw("(count(status)) as countStatus"),
            )
            ->where('status', '=', 0)
            ->get();
        return response()->json($result);
    }
    //Tạo một Bill
    public function store(Request $request)
    {

    }
    //Lấy một Bill theo $id
    public function show($id)
    {
        $result = DB::table('tbl_bill')
            ->join('tbl_bill_info', 'tbl_bill_info.id_bill', '=', 'tbl_bill.id')
            ->join('tbl_product_info', 'tbl_product_info.id', '=', 'tbl_bill_info.id_product_info')
            ->join('tbl_product', 'tbl_product.id', '=', 'tbl_product_info.id_product')
            ->join('tbl_color', 'tbl_color.id', '=', 'tbl_product_info.id_color')
            ->join('tbl_size', 'tbl_size.id', '=', 'tbl_product_info.id_size')
            ->select(
                'tbl_product.image',
                'tbl_bill_info.quantity',
                'tbl_product.name',
                'tbl_bill.status',
                'tbl_color.name as nameColor',
                'tbl_size.name as nameSize',
                'tbl_product.id',
            )
            ->where('id_customer', '=', $id, 'and status = 1')

            ->get();
        return response()->json($result);
    }
    public function showWaitBill($id)
    {
        $result = DB::table('tbl_bill')
            ->join('tbl_bill_info', 'tbl_bill_info.id_bill', '=', 'tbl_bill.id')
            ->join('tbl_product_info', 'tbl_product_info.id', '=', 'tbl_bill_info.id_product_info')
            ->join('tbl_product', 'tbl_product.id', '=', 'tbl_product_info.id_product')
            ->join('tbl_color', 'tbl_color.id', '=', 'tbl_product_info.id_color')
            ->join('tbl_size', 'tbl_size.id', '=', 'tbl_product_info.id_size')
            ->select(
                'tbl_product.image',
                'tbl_bill_info.quantity',
                'tbl_product.name',
                'tbl_bill.status',
                'tbl_color.name as nameColor',
                'tbl_size.name as nameSize',
                'tbl_product.id',
            )
            ->where('id_customer', '=', $id, 'and status = 0')

            ->get();
        return response()->json($result);
    }
    //Cập Nhật một Bill theo $id
    public function update(Request $request)
    {
        DB::table('tbl_bill')
            ->where('id', $request->id)
            ->update(
                [
                    'status' => (int) $request->status,

                    'delivery_date' => $request->delivery_date,
                    'id_staff' => $request->id_staff,

                ]

            );

        return response()->json($request);
    }
    //Xóa một Size theo $id
    public function destroy($id)
    {
        DB::table('tbl_bill')->where('id', '=', $id)->delete();
        return response()->json($id);
    }
    //Lấy một Bill Info theo $id
    public function DetailOrder($id)
    {
        $result = DB::table('tbl_bill')
            ->join('tbl_bill_info', 'tbl_bill_info.id_bill', '=', 'tbl_bill.id')
            ->join('tbl_product_info', 'tbl_product_info.id', '=', 'tbl_bill_info.id_product_info')
            ->join('tbl_product', 'tbl_product.id', '=', 'tbl_product_info.id_product')
            ->join('tbl_color', 'tbl_color.id', '=', 'tbl_product_info.id_color')
            ->join('tbl_size', 'tbl_size.id', '=', 'tbl_product_info.id_size')
            ->select(
                'tbl_product.image',
                'tbl_bill_info.quantity',
                'tbl_bill_info.into_money',
                'tbl_product.name',
                'tbl_product.price as priceProduct',

                'tbl_color.name as nameColor',
                'tbl_size.name as nameSize',
                'tbl_product.name',
            )
            ->where('tbl_bill.id', '=', $id)

            ->get();
        return response()->json($result);
    }

}
