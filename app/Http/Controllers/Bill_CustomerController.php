<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Bill_CustomerController extends Controller
{
    //Lấy tất cả danh sách  Bill_Customer
    public function index()
    {
        $result = DB::table('tbl_bill')

            ->select('*')
            ->get();
        return response()->json($result);
    }
    //Tạo một  Bill_Customer
    public function store(Request $request)
    {
        DB::table('tbl_bill')->insert(
            [
                "id" => $request->id,
                "order_date" => $request->order_date,
                "total" => $request->total,
                "status" => $request->status,
                "id_customer" => $request->id_customer,
                "address" => $request->address,
                "phone" => $request->phone,
                "email" => $request->email,
                "total_quantity" => $request->total_quantity,
                "note" => $request->note,
                "name_customer"=>$request->name_customer,
            ]
        );
        return response()->json($request);
    }
    //Lấy một  Bill_Customer theo $id
    public function show($id)
    {
        $result = DB::table('tbl_bill')
            ->select('*')
            ->where('id_customer', '=', $id)
            ->orderBy('tbl_bill.order_date', 'DESC')
            ->get();
        return response()->json($result);

    }
    //Cập nhật một  Bill_Customertheo $id
    public function update($id)
    {
    }
    //Xóa một  Bill_Customer theo $id
    public function destroy($id)
    {
    }
}
