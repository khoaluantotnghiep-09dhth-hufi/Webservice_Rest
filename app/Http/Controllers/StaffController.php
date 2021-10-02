<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

        $rs = DB::table('tbl_staff')->where('email', '=', $request->email)->first();
        if ($rs === null) {
            DB::table('tbl_staff')->insert(
                [
                    "id" => $request->id,
                    "name" => $request->name,
                    "email" => $request->email,
                    "phone" => $request->phone,
                    "address" => $request->address,
                    "password" => '123456',
                    "role" => 1,
                    "image" => $request->image,
                ]
            );
            return response()->json($request);
        } else {
            //echo '500 nè';
            return response()->json($request, 500);
        }

    }
    //Lấy một Staff theo $id
    public function show($id)
    {
        $result = DB::table('tbl_staff')
            ->select(
                'id',
                'name',
                'gender',
                'place_of_birth',
                'image',
                'cmnn_cccc',
                'address',
                'email',
                'phone',
                'password',
                'role'
            )
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
                    "name" => $request->name,
                    "email" => $request->email,
                    "phone" => $request->phone,
                    "address" => $request->address,
                    "image" => $request->image,
                ]

            );
        return response()->json($request);
    }
    public function updatePassword(Request $request)
    {
        DB::table('tbl_staff')
            ->where('id', $request->id)
            ->update(
                [
                    "password" => $request->password,
                ]
            );
        return response()->json($request);
    }
    public function updateProfile(Request $request)
    {
        DB::table('tbl_staff')
            ->where('id', $request->id)
            ->update(
                [
                    "name" => $request->name,
                    "phone" => $request->phone,
                    "address" => $request->address,
                    "cmnn_cccc" => $request->cmnn_cccc,
                    "gender" => $request->gender,
                    "place_of_birth" => $request->place_of_birth,
                    "image" => $request->image,
                ]

            );
        return response()->json($request);
    }
    //Cập nhật vị trí một Staff theo $id
    public function updateAccount(Request $request)
    {
        DB::table('tbl_staff')
            ->where('id', $request->id)
            ->update(
                [
                    "role" => $request->role,
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
