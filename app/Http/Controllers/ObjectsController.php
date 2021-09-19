<?php
//Kiểm tra class thêm vào chưa
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Objects;
use App\Models\Sector;
use Illuminate\Support\Facades\DB;

class ObjectsController extends Controller
{
    //Lấy tất cả danh sách Object
    public function index()
    {

        $result = DB::table('tbl_object')

            ->select('*')
            ->get();
        return response()->json($result);
    }
    // public function index2(Request $request)
    // {
    //     $rs = DB::table('tbl_object')->where('id', $request->id)->first();
    //     return response()->json($rs);
    // }
    //Tạo một Object
    public function store(Request $request)
    {
        DB::table('tbl_object')->insert(
            [
                "id" => $request->id,
                "name" => $request->nameObject,

            ]
        );
        return response()->json($request);
    }
    //Lấy một Object theo $id
    public function show($id)
    {
        $result = DB::table('tbl_object')

            ->where('id', '=', $id)

            ->get();
        return response()->json($result);
    }
    //Cập nhật một Object theo $id
    public function update(Request $request)
    {
        DB::table('tbl_object')
            ->where('id', $request->idItem)
            ->update(
                [
                    'name' => $request->nameObject,
                ]

            );
        return response()->json($request);
    }
    //Xóa một Object theo $id
    public function destroy($id)
    {
        DB::table('tbl_object')->where('id', '=', $id)->delete();
        return response()->json($id);
    }
}
