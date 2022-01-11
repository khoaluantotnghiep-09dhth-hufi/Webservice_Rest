<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SizeController extends Controller
{
    //Lấy tất cả danh sách Color
    public function index()
    {
        $result = DB::table('tbl_size')->select('*')
        ->orderBy('tbl_size.id', 'ASC')
        ->get();
        return response()->json($result);
    }
    //Tạo một Color
    public function store(Request $request)
    {
        DB::table('tbl_size')->insert(
            [
                "id" => $request->id,
                "name" => $request->name,
            ]
        );
        return response()->json($request);
    }
    //Lấy một Size theo $id
    public function show($id)
    {
        $result = DB::table('tbl_size')
            ->select(
                'tbl_size.id',
                'tbl_size.name',
                )
            ->where('id', '=', $id)

            ->get();
        return response()->json($result);
    }
    //Cập Nhật một Size theo $id
    public function update(Request $request)
    {
        DB::table('tbl_size')
            ->where('id', $request->id)
            ->update(
                [
                    'name' => $request->name,
                ]

            );
        return response()->json($request);
    }
    //Xóa một Size theo $id
    public function destroy($id)
    {
        DB::table('tbl_size')->where('id', '=', $id)->delete();
        return response()->json($id);
    }
}
