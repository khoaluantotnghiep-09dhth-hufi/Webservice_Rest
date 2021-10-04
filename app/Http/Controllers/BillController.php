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

            ->where('id', '=', $id)

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

                    'delivery_date'=> $request->delivery_date,
                    'id_staff'=> $request->id_staff,

                 

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
}
