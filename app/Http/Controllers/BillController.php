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
        $result = DB::table('tbl_bill')
            ->select(DB::raw('SUM(total) AS sumTotal'))
            ->where('tbl_bill.order_date', '=', 'tbl_bill.order_date')
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
                    'delivery_date' => $request->delivery_date,
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
