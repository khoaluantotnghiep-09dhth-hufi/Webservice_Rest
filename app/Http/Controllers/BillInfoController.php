<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class BillInfoController extends Controller
{
    //Lấy tất cả danh sách Bill info
    public function index()
    {
        $result =DB::table('tbl_bill_info')->select('*')->get();
        return response()->json($result);
    }
    //Tạo một Bill info
    public function store(Request $request)
    {
        DB::table('tbl_bill_info')->insert(
            [
                "id" => $request->id,
                "id_bill" => $request->id_bill,
                "id_product_info" => $request->id_product_info,
                "into_money" => $request->into_money,
                "quantity" => $request->quantity,
            ]
        );
        return response()->json($request);
    }
    //Lấy một Bill info theo $id
    public function show($id)
    {
    }
    //Cập Nhật một Bill info theo $id
    public function update(Request $request)
    {
    }
    //Xóa một bill info theo $id
    public function destroy($id)
    {
    }
}
