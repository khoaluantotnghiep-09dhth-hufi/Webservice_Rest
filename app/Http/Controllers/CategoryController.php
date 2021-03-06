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
        $result = DB::table('tbl_category')
            ->join('tbl_sectors', 'tbl_sectors.id', '=', 'tbl_category.id_sectors')
            ->select(
                'tbl_category.id',
                'tbl_category.name',
                'tbl_sectors.name as nameSector',
                'tbl_category.id_sectors',
                'tbl_category.image'
            )
            ->orderBy('tbl_category.id', 'DESC')
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
                "image" => $request->image,
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
            ->select('*')
            ->get();
        return response()->json($result);
    }
    //Cập nhật một Category theo $id
    public function update(Request $request)
    {
        DB::table('tbl_category')
            ->where('id', $request->id)
            ->update(
                [
                    'name' => $request->name,
                    'id_sectors' => $request->id_sector,
                    "image" => $request->image,
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
