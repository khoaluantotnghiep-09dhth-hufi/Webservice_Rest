<?php
//Kiểm tra class thêm vào chưa
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ColorController extends Controller
{
    //Lấy tất cả danh sách Color
    public function index()
    {
        $result = DB::table('tbl_color')->select('*')->get();
        return response()->json($result);
    }
    //Tạo một Color
    public function store(Request $request)
    {
        DB::table('tbl_color')->insert(
            [
                "id" => $request->id,
                "name" => $request->nameColor,
            ]
        );
        return response()->json($request);
    }
    //Lấy một Color theo $id
    public function show($id)
    {
        $result = DB::table('tbl_color')

            ->where('id', '=', $id)

            ->get();
        return response()->json($result);
    }
    //Cập Nhật một Color theo $id
    public function update(Request $request)
    {
        DB::table('tbl_color')
            ->where('id', $request->id)
            ->update(
                [
                    'name' => $request->nameColor,
                ]

            );
        return response()->json($request);
    }
    //Xóa một Color theo $id
    public function destroy($id)
    {
        DB::table('tbl_color')->where('id', '=', $id)->delete();
        return response()->json($id);
    }
}
