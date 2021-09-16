<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Bill;
class BillController extends Controller
{
    //Lấy tất cả danh sách Bill
    public function index()
    {
        $result = DB::table('tbl_bill')->select('*')->get();
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
                    'status' => (int) $request->name,
                ]

            );

        // $result= Bill::where('id', $request->idBill)->update(['status' => $request->status]);;

        // Make sure you've got the Page model
        // if($result) {
        //     $result->status = $request->status;
        //     $result->save();
        // }

        return response()->json($request);
    }
    //Xóa một Size theo $id
    public function destroy($id)
    {
        DB::table('tbl_bill')->where('id', '=', $id)->delete();
        return response()->json($id);
    }
}
