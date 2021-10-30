<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillInfoController extends Controller
{
    //Lấy tất cả danh sách Bill info
    public function index()
    {
        $result = DB::table('tbl_bill_info')->select('*')->get();
        return response()->json($result);
    }
    //Tạo một Bill info
    public function store(Request $request)
    {
        $data = $request->all();
        // $data = array(
        //     "id" => $request->id,
        //     "id_bill" => $request->id_bill,
        //     "id_product_info" => $request->id_product_info,
        //     "into_money" => $request->into_money,
        //     "quantity" => $request->quantity,
        // );
        // DB::table('tbl_bill_info')->insert($data);
        foreach ($data as $key => $value) {
            $arrData = array($value);
            DB::table('tbl_bill_info')->insert($arrData);
        }

        //   $result=  DB::table('tbl_bill_info')->insert(
        //         [
        //             "id" => $request->id_bill_info,
        //             "id_bill" => $request->id_bill,
        //             "id_product_info" => $request->id_product_info,
        //             "into_money" => $request->into_money,
        //             "quantity" => $request->quantity,

        //         ]
        //     );

        return response()->json($data);
        // return     json_encode($request->all(),true);
    }
     //Tạo một Bill info mobile
     public function store_mobile(Request $request)
     {

        $data = json_decode($request,true);
        var_dump($data);
        foreach ($data  as $key => $value) {

            $arrData = array($value);
            DB::table('tbl_bill_info')->insert($arrData);
        }
//   $result=  DB::table('tbl_bill_info')->insert(
        //         [
        //             "id" => $request->id_bill_info,
        //             "id_bill" => $request->id_bill,
        //             "id_product_info" => $request->id_product_info,
        //             "into_money" => $request->into_money,
        //             "quantity" => $request->quantity,

        //         ]
        //     );

        return response()->json($data);



     }
    //Lấy một Bill info theo $id
    public function show($id)
    {
    }
    //Cập Nhật một Bill info theo $id
    public function update(Request $request)
    {
        DB::table('tbl_bill_info')
            ->where('id', $request->id)
            ->update(
                [
                    'id_product_info' => (int) $request->id_product_info,
                    'quantity' => $request->quantity,
                ]
            );

        return response()->json($request);
    }
    //Xóa một bill info theo $id
    public function destroy($id)
    {
    }
}
