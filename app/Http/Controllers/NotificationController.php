<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    //Lấy tất cả danh sách Object
    public function index()
    {

        $result = DB::table('tbl_notification')

            ->select('*')
            ->get();
        return response()->json($result);
    }

    public function store(Request $request)
    {
        DB::table('tbl_notification')->insert(
            [
                "id" => $request->id,
                "is_read"=>0,
                "time"=>$request->time,
                "content" => $request->content,

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
                    'name' => $request->name,
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
