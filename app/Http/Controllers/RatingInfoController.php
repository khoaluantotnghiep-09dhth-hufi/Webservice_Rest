<?php
//Kiểm tra class thêm vào chưa
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RatingInfoController extends Controller
{

    public function index()
    {
        $result = DB::table('tbl_rating_info')
            ->join('tbl_bill_info', 'tbl_bill_info.id', '=', 'tbl_rating_info.id_bill_info')
            ->join('tbl_product_info', 'tbl_product_info.id', '=', 'tbl_bill_info.id_product_info')
            ->select(
                'tbl_rating_info.id',
                'id_rating',
                'tbl_rating_info.id_bill_info',
                'count',
            )
        // ->avg('count')
            ->get();
        return response()->json($result);
    }

    public function store(Request $request)
    {
        DB::table('tbl_rating_info')->insert(
            [
                "id" => $request->id,
                "id_rating" => $request->id_rating,
                "id_bill_info" => $request->id_bill_info,
                "count" => $request->count,
            ]
        );
        return response()->json($request);
    }

    public function show($id)
    {
        $result = DB::table('tbl_rating_info')
            ->where('tbl_rating_info.id', '=', $id)
            ->select('*')
            ->get();
        return response()->json($result);
    }

    public function update(Request $request)
    {
        DB::table('tbl_rating_info')
            ->where('id', $request->id)
            ->update(
                [
                    "id_rating" => $request->id_rating,
                    "id_bill_info" => $request->id_bill_info,
                    "count" => $request->count,
                ]

            );
        return response()->json($request);
    }

    public function destroy($id)
    {
        DB::table('tbl_rating_info')->where('id', '=', $id)->delete();
        return response()->json($id);
    }
}
