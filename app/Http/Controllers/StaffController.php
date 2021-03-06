<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaffController extends Controller
{
    //Lấy tất cả danh sách Staff
    public function login(Request $request)
    {
        $passwordMd5 = md5($request->password);
        $result = DB::table("tbl_staff")
        ->where("tbl_staff.email", "=", $request->phone)
        ->where("tbl_staff.password", "=", $passwordMd5)
        ->get();
        // dd($result);
        return response()->json($result);
    }
    public function index()
    {
        $result = DB::table('tbl_staff')
            ->select(
                '*'
            )
            ->orderBy('tbl_staff.id', 'DESC')
            ->get();
        return response()->json($result);
    }
    public function index2()
    {
        $result = DB::table('tbl_staff')
            ->select(DB::raw('count(*) AS countStaff'))
            ->get();
        return response()->json($result);
    }
    //Tạo một Staff
    public function store(Request $request)
    {
        $passwordMd5 = md5($request->password);

        $rs = DB::table('tbl_staff')->where('email', '=', $request->email)->first();
        if ($rs === null) {
            DB::table('tbl_staff')->insert(
                [
                    "id" => $request->id,
                    "name" => $request->name,
                    "email" => $request->email,
                    "phone" => $request->phone,
                    "address" => $request->address,
                    "password" => $passwordMd5,
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
        $passwordMd5 = md5($request->password);

        DB::table('tbl_staff')
            ->where('id', $request->id)
            ->update(
                [
                    "name" => $request->name,
                    "email" => $request->email,
                    "phone" => $request->phone,
                    "address" => $request->address,
                    "password" => $passwordMd5,

                    "image" => $request->image,
                ]

            );
        return response()->json($request);
    }
    public function updatePassword(Request $request)
    {
        $passwordMd5 = md5($request->password);

        DB::table('tbl_staff')
            ->where('id', $request->id)
            ->update(
                [
                    "password" => $passwordMd5,
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
