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
        $result = DB::table('tbl_news')
            ->join('tbl_staff', 'tbl_staff.id', '=', 'tbl_news.id_staff')
            ->select(
                'tbl_news.id',
                'tbl_news.title',
                'tbl_news.date',
                'tbl_staff.name',
                'tbl_news.image',
                'tbl_news.descriptionHTML',
                'tbl_news.descriptionText'
            )
            ->orderBy('tbl_news.id', 'DESC')
            ->get();
        return response()->json($result);
    }

    public function store(Request $request)
    {
        DB::table('tbl_news')->insert(
            [
                "id" => $request->id,
                "title" => $request->title,
                "date" => $request->date,
                "descriptionHTML" => $request->descriptionHTML,
                "descriptionText" => $request->descriptionText,
                "id_staff" => $request->id_staff,
                "image" => $request->image,
            ]
        );
        return response()->json($request);
    }
    //Lấy một Category theo $id
    public function show($id)
    {
        $result = DB::table('tbl_news')
        ->select('*')
        ->where('id', $id)
        ->first();
        return response()->json($result);
    }
    //Cập nhật một Category theo $id
    public function update(Request $request,$id)
    {
        DB::table('tbl_news')
            ->where('id', $id)
            ->update(
                [
                    "title" => $request->title,
                    "date" => $request->date,
                    "descriptionHTML" => $request->descriptionHTML,
                    "descriptionText" => $request->descriptionText,
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
