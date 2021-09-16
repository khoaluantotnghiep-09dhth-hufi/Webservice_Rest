<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaffController extends Controller
{
    //Lấy tất cả danh sách Staff
    public function index()
    {
        $result = DB::table('tbl_staff')
            ->select(
                '*'
            )
            ->get();
        return response()->json($result);
    }
    //Tạo một Staff
    public function store(Request $request)
    {
        DB::table('tbl_staff')->insert(
            [
                "id" => $request->id,
                "name" => $request->nameStaff,
                "email" => $request->email,
                "phone" => $request->phone,
                "address" => $request->address,
                "password" => $request->password,
                "postion" => $request->position,

            ]
        );
        return response()->json($request);
    }
    //Lấy một Staff theo $id
    public function show($id)
    {
        $result = DB::table('tbl_staff')

            ->where('id', '=', $id)

            ->get();
        return response()->json($result);
    }
    //Cập nhật một Staff theo $id
    public function update(Request $request)
    {
        DB::table('tbl_staff')
            ->where('id', $request->id)
            ->update(
                [
                    "name" => $request->nameStaff,
                    "email" => $request->email,
                    "phone" => $request->phone,
                    "address" => $request->address,
                    "password" => $request->password,
                    "postion" => $request->position,
                ]

            );
        return response()->json($request);
    }
    //Xóa một Staff theo $id
    public function destroy($id)
    {
        DB::table('tbl_staff')->where('id', '=', $id)->delete();
        return response()->json($id);
    }
}
