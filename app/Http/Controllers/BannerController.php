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
         ->orderBy('tbl_banner.id', 'DESC')
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
     public function show(Request $request)
     {

         $result = DB::table('tbl_banner')
         ->select('*')
             ->where('tbl_banner.id', '=', $request->id)
             ->get();
            //  dd($result);
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
     public function destroy(Request $request)
     {
        $result=  DB::table('tbl_banner')
         ->where('tbl_banner.id', '=', $request->id)
        ->delete();
         return response()->json($result);
     }
}
