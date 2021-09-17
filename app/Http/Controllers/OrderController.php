<?php
//Kiểm tra class thêm vào chưa
namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {

        $result = DB::table('tbl_order')
            ->select('*')
            ->get();
        return response()->json($result);
    }

    public function store(Request $request)
    {
        DB::table('tbl_order')->insert(
            [
                // Carbon::createFromFormat('d/m/Y', $request->date_order)->format('Y-m-d'),
                "id" => $request->id,
                "date_order" => $request->date_order,
                'name_warehouse' => $request->name_warehouse,
                'status' => $request->status
            ]
        );
        return response()->json($request);
    }
    //Lấy một Product theo $id
    public function show($id)
    {
        
    }
    //Cập nhật một Product theo $id
    public function update(Request $request)
    {
        DB::table('tbl_order')
        ->where('id', $request->id)
        ->update(
            [
                'date_order' => $request->date_order,
                'name_warehouse' => $request->name_warehouse,
                'status' => $request->status,
            ]

        );
    return response()->json($request);
    }
    //Xóa một Product theo $id
    public function destroy($id)
    {
        DB::table('tbl_order')->where('id', '=', $id)->delete();
        return response()->json($id);
    }
}
