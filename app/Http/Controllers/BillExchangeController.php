<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillExchangeController extends Controller
{
    //Lấy tất cả danh sách Bill info
    public function index()
    {
        $result = DB::table('tbl_bill_info')
            ->join('tbl_bill', 'tbl_bill.id', '=', 'tbl_bill_info.id_bill')
            ->join('tbl_customer', 'tbl_customer.id', '=', 'tbl_bill.id_customer')
            ->join('tbl_product_info', 'tbl_product_info.id', '=', 'tbl_bill_info.id_product_info')
            ->join('tbl_product', 'tbl_product.id', '=', 'tbl_product_info.id_product')
            ->select(
                'tbl_customer.name',
                'tbl_bill.id as idBill',
                'tbl_bill_info.id',
                'tbl_bill_info.quantity',
                'tbl_bill_info.into_money',
                'tbl_product.name as nameProduct',
                'tbl_bill_info.id_product_info as idProductInfo'
            )
            ->where('status_exchange', '=', '0')
            ->orderBy('tbl_bill_info.id', 'DESC')
            ->get();
        return response()->json($result);
    }
    //Tạo một Bill info
    public function store(Request $request)
    {
        $data = $request->all();
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

        return response()->json($arrData);
        // return     json_encode($request->all(),true);
    }
    //Lấy một Bill info theo $id
    public function show($id)
    {
        $result = DB::table('tbl_product_info')
            ->join('tbl_bill_info', 'tbl_bill_info.id_product_info', '=', 'tbl_product_info.id')
            ->join('tbl_product', 'tbl_product.id', '=', 'tbl_product_info.id_product')
            ->join('tbl_size', 'tbl_size.id', '=', 'tbl_product_info.id_size')
            ->join('tbl_color', 'tbl_color.id', '=', 'tbl_product_info.id_color')
            ->select(
                'tbl_product_info.id',
                'tbl_product.name as nameProduct',
                'tbl_size.name as nameSize',
                'tbl_color.name as nameColor'
            )
            ->where('tbl_bill_info.id', '=', $id)
            ->get();
        return response()->json($result);
    }
    //Cập Nhật một Bill info theo $id
    public function update(Request $request)
    {
    }
    //Xóa một bill info theo $id
    public function destroy($id)
    {
    }
}
