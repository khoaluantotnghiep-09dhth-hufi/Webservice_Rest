<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BannerController extends Controller
{
     //Lấy tất cả danh sách Banner
     public function index()
     {
         $result = DB::table('tbl_banner')->select('*')

         ->get();
         return response()->json($result);
     }
     //Tạo một Banner
     public function store(Request $request)
     {
         DB::table('tbl_banner')->insert(
             [
                 "id" => $request->id,
                 "image" => $request->image,
                 "is_active"=> $request->is_active,
             ]
         );
         return response()->json($request);
     }
     //Lấy một Banner theo $id
     public function show($id)
     {
         $result = DB::table('tbl_banner')
             ->select(
                "*"
                 )

             ->where('id', '=', $id)

             ->get();
         return response()->json($result);
     }
     //Cập Nhật một banner theo $id
     public function update(Request $request)
     {
         DB::table('tbl_banner')
             ->where('id', $request->id)
             ->update(
                 [
                     'image' => $request->image,
                     'is_active' =>$request->is_active,
                 ]

             );
         return response()->json($request);
     }
     //Xóa một Color theo $id
     public function destroy($id)
     {
        $result= DB::table('tbl_banner')->where('id', '=', $id)->delete();
         return response()->json($result);
     }
}
