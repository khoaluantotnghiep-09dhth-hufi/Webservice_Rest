<?php
//Kiểm tra class thêm vào chưa
namespace App\Http\Controllers;

use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SectorController extends Controller
{
    //Lấy tất cả danh sách Sector
    public function index()
    {
        // $result = Sector::all();
        $result = DB::table('tbl_sectors')->select('*')->get();
        return response()->json($result);
    }
    public function index2(Request $request)
    {
       $rs = DB::table('tbl_sectors')->where('id', $request->id)->first();
       return response()->json($rs);
    }
    //Tạo một Sector
    public function store(Request $request)
    {
        DB::table('tbl_sectors')->insert(
            ["id" => $request->id,
             "name" => $request->name,
                "id_object" => $request->id_object,
            ]
        );
        return response()->json($request);
    }
    //Lấy một Sector theo $id
    public function show(Request $request)
    {
        $rs = DB::table('tbl_sectors')->where('id', $request->id)->first();
       return response()->json($rs);
    }
    //Cập nhật một Sector theo $id
    public function update(Request $request)
    {
        DB::table('tbl_sectors')
            ->where('id', $request->id)
            ->update(
                [
                    'name' => $request->name,
                    'id_object' =>$request->id_object,
                ]
                
        );
        return response()->json($request);
    }
    //Xóa một Sector theo $id
    public function destroy($id)
    {
        DB::table('tbl_sectors')->where('id', '=', $id)->delete();
        return response()->json($id);
    }
}
