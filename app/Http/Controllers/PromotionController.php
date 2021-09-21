<?php
//Kiểm tra class thêm vào chưa
namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromotionController extends Controller
{
    //Lấy tất cả danh sách Promotion
    public function index()
    {
        $result = DB::table('tbl_promotion')->select('*')->get();
        return response()->json($result);
    }
    //Tạo một Promotion
    public function store(Request $request)
    {
        DB::table('tbl_promotion')->insert(
            [
                "id" => $request->id,
                "name" => $request->name,
                "date_start" => $request->date_start,
                "date_end" => $request->date_end,
                "desciption" => $request->desciption

            ]
        );
        return response()->json($request);
    }
    //Lấy một Promotion theo $id
    public function show($id)
    {
        $result = DB::table('tbl_promotion')

            ->where('id', '=', $id)

            ->get();
        return response()->json($result);
    }
    //Cập nhật một Promotion theo $id
    public function update(Request $request)
    {
        DB::table('tbl_promotion')
        ->where('id', $request->id)
        ->update(
            [
                "name" => $request->name,
                "date_start" => $request->date_start,
                "date_end" => $request->date_end,
                "desciption" => $request->desciption
            ]

    );
    return response()->json($request);
    }
    //Xóa một Promotion theo $id
    public function destroy($id)
    {
        DB::table('tbl_promotion')->where('id', '=', $id)->delete();
        return response()->json($id);
    }
}
