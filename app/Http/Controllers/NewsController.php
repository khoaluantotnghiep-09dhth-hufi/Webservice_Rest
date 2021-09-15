<?php
//Kiểm tra class thêm vào chưa
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    //Lấy tất cả danh sách Category
    public function index()
    {
        // $result=Category::all();
        // $result = DB::table('tbl_category')
        //     ->join('tbl_sectors', 'tbl_sectors.id', '=', 'tbl_category.id_sectors')

        //     ->select('tbl_sectors.id','tbl_sectors.name','tbl_category.id','tbl_category.name')
        //     ->get();
        $result = DB::table('tbl_news')->select('*')->get();
        return response()->json($result);
    }
    //Tạo một Category
    public function store(Request $request)
    {
        DB::table('tbl_news')->insert(
            ["id" => $request->id,
                "title" => $request->title,
                "date" => $request->date,
                "description" => $request->description,
                "id_staff" => $request->id_staff,
                "image" => $request->image,
               
            ]
        );
        return response()->json($request);
    }
    //Lấy một Category theo $id
    public function show(Request $request)
    {
        $rs = DB::table('tbl_news')->where('id', $request->id)->first();
        return response()->json($rs);
    }
    //Cập nhật một Category theo $id
    public function update(Request $request)
    {
        DB::table('tbl_news')
            ->where('id', $request->id)
            ->update(
                [
                    "title" => $request->title,
                    "date" => $request->date,
                    "description" => $request->description,
                    "id_staff" => $request->id_staff,
                    "image" => $request->image,
                    
                ]

            );
        return response()->json($request);
    }
    //Xóa một Category theo $id
    public function destroy($id)
    {
        DB::table('tbl_news')->where('id', '=', $id)->delete();
        return response()->json($id);
    }
}
