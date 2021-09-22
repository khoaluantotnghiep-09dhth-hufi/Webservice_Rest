<?php
//Kiểm tra class thêm vào chưa
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImportController extends Controller
{
    //Lấy tất cả danh sách nhập hàng
    public function index()
    {
        $result = DB::table('tbl_import')->join('tbl_order', 'tbl_order.id', '=', 'tbl_import.id_order')
            ->select(
                'tbl_import.id', 'tbl_import.date_import', 'tbl_order.name_warehouse as nameWarehouse', 'tbl_import.id_order', 'tbl_import.total_import'
            )
            ->get();
        return response()->json($result);
    }
    //Tạo một phiếu nhập
    public function store(Request $request)
    {
        DB::table('tbl_import')->insert(
            [
                "id" => $request->id,
                "date_import" => $request->date_import,
                "id_order" => $request->id_order,
                "total_import" => $request->total_import,
            ]
        );
        return response()->json($request);
    }
    //Lấy một phiếu nhập theo $id
    public function show($id)
    {
        $result = DB::table('tbl_import')
            ->join('tbl_import', 'tbl_order.id', '=', 'tbl_import.id_order')
            ->where('tbl_import.id_order', '=', $id)
            ->select('tbl_import.id', 'tbl_order.name_warehouse')
            ->get();
        return response()->json($result);
    }
    //Cập nhật một phiếu nhập theo $id
    public function update(Request $request)
    {
        DB::table('tbl_import')
            ->where('id', $request->id)
            ->update(
                [
                    "date_import" => $request->date_import,
                    "id_order" => $request->id_order,
                    "total_import" => $request->total_import,
                ]
            );
        return response()->json($request);
    }
    //Xóa một phiếu nhập theo $id
    public function destroy($id)
    {
        DB::table('tbl_import')->where('id', '=', $id)->delete();
        return response()->json($id);
    }
}