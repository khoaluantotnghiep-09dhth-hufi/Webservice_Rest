<?php
//Kiểm tra class thêm vào chưa
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    //Lấy tất cả danh sách Category
    public function index()
    {
        // $result=Category::all();
        // $result = DB::table('tbl_category')
        //     ->join('tbl_sectors', 'tbl_sectors.id', '=', 'tbl_category.id_sectors')

        //     ->select('tbl_sectors.id','tbl_sectors.name','tbl_category.id','tbl_category.name')
        //     ->get();
        $result = DB::table('tbl_category')->join('tbl_sectors', 'tbl_sectors.id', '=', 'tbl_category.id_sectors')
            ->select(
                'tbl_category.id', 'tbl_category.name', 'tbl_sectors.name as nameSector'
            )
            ->get();
        return response()->json($result);
    }
    //Tạo một Category
    public function store(Request $request)
    {
        DB::table('tbl_category')->insert(
            ["id" => $request->id,
                "name" => $request->name,
                "id_sectors" => $request->id_sector,
            ]
        );
        return response()->json($request);
    }
    //Lấy một Category theo $id
    public function show($id)
    {
        $result = DB::table('tbl_sectors')
            ->join('tbl_category', 'tbl_sectors.id', '=', 'tbl_category.id_sectors')
        // ->join('tbl_object','tbl_sectors.id_object','=','tbl_object.id')
            ->where('tbl_category.id_sectors', '=', $id)
            ->select('tbl_category.id', 'tbl_category.name')
            ->get();
        return response()->json($result);
    }
    //Cập nhật một Category theo $id
    public function update(Request $request)
    {
        DB::table('tbl_category')
            ->where('id', $request->idItem)
            ->update(
                [
                    'name' => $request->name,
                    'id_sectors' => $request->id_sectors,
                ]

            );
        return response()->json($request);
    }
    //Xóa một Category theo $id
    public function destroy($id)
    {
        DB::table('tbl_category')->where('id', '=', $id)->delete();
        return response()->json($id);
    }
}
