<?php
//Kiểm tra class thêm vào chưa
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RatingController extends Controller
{

    public function index()
    {
        $result = DB::table('tbl_rating')
            ->select(
                '*'
            )
            ->get();
        return response()->json($result);
    }

    public function store(Request $request)
    {
        DB::table('tbl_rating')->insert(
            [
                "id" => $request->id,
                "name" => $request->name,
            ]
        );
        return response()->json($request);
    }

    public function show($id)
    {
        $result = DB::table('tbl_rating')
            ->where('tbl_rating.id', '=', $id)
            ->select('*')
            ->get();
        return response()->json($result);
    }

    public function update(Request $request)
    {
        DB::table('tbl_rating')
            ->where('id', $request->id)
            ->update(
                [
                    'name' => $request->name,
                ]

            );
        return response()->json($request);
    }

    public function destroy($id)
    {
        DB::table('tbl_rating')->where('id', '=', $id)->delete();
        return response()->json($id);
    }
}
