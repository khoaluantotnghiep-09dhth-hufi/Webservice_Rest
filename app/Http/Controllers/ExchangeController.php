<?php
//Kiểm tra class thêm vào chưa
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ExchangeController extends Controller
{
    public function index()
    {
        $result = DB::table('tbl_product_exchange')
            ->join('tbl_bill_info', 'tbl_bill_info.id', '=', 'tbl_product_exchange.id_bill_info')
            ->join('tbl_bill', 'tbl_bill.id', '=', 'tbl_bill_info.id_bill')
            ->join('tbl_product_info', 'tbl_product_info.id', '=', 'tbl_bill_info.id_product_info')
            ->join('tbl_customer', 'tbl_customer.id', '=', 'tbl_bill.id_customer')
            ->join('tbl_product', 'tbl_product.id', '=', 'tbl_product_info.id_product')
            ->join('tbl_size', 'tbl_size.id', '=', 'tbl_product_info.id_size')
            ->join('tbl_color', 'tbl_color.id', '=', 'tbl_product_info.id_color')
            ->join('tbl_staff', 'tbl_staff.id', '=', 'tbl_product_exchange.id_staff_change')
            ->select(
                'tbl_product.name as nameProduct',
                'tbl_size.name as nameSize',
                'tbl_color.name as nameColor',
                'tbl_customer.name as nameCustomer',
                'tbl_bill_info.quantity',
                'tbl_product.price',
                'tbl_product_exchange.reason',
                'tbl_product_exchange.id',
                'tbl_bill_info.id as idBillInfo',
                'tbl_staff.name as nameStaff',
                'tbl_product_exchange.id_staff_change'
            )
            ->orderBy('tbl_customer.name')
            ->get();
        return response()->json($result);
    }
   
    public function store(Request $request)
    {
        DB::table('tbl_product_exchange')->insert(
            [
                "id" => $request->id,
                "id_bill_info" => $request->id_bill_info,
                "id_staff_change" => $request->id_staff_change,
                "reason" => $request->reason,
            ]
        );
        return response()->json($request);
    }
    public function show($id)
    {
        $result = DB::table('tbl_product_exchange')
            ->join('tbl_bill_info', 'tbl_bill_info.id', '=', 'tbl_product_exchange.id_bill_info')
            ->join('tbl_bill', 'tbl_bill.id', '=', 'tbl_bill_info.id_bill')
            ->join('tbl_product_info', 'tbl_product_info.id', '=', 'tbl_bill_info.id_product_info')
            ->join('tbl_customer', 'tbl_customer.id', '=', 'tbl_bill.id_customer')
            ->join('tbl_product', 'tbl_product.id', '=', 'tbl_product_info.id_product')
            ->join('tbl_size', 'tbl_size.id', '=', 'tbl_product_info.id_size')
            ->join('tbl_color', 'tbl_color.id', '=', 'tbl_product_info.id_color')
            ->join('tbl_staff', 'tbl_staff.id', '=', 'tbl_bill.id_staff')
            ->select(
                'tbl_product.name as nameProduct',
                'tbl_size.name as nameSize',
                'tbl_color.name as nameColor',
                'tbl_customer.name as nameCustomer',
                'tbl_bill_info.quantity',
                'tbl_product.price',
                'tbl_product_exchange.reason',
                'tbl_product_exchange.id',
                'tbl_bill_info.id as idBillInfo',
                'tbl_staff.name as nameStaff',
            )
            ->where('tbl_bill_info.id', $id)
            ->orderBy('tbl_customer.name')
            ->get();
        return response()->json($result);
    }
    
    public function update(Request $request)
    {
        DB::table('tbl_product_exchange')
            ->where('id', $request->id)
            ->update(
                [
                    "id" => $request->id,
                    "id_bill_info" => $request->id_bill_info,
                    "reason" => $request->reason,
                ]

            );
        return response()->json($request);
    }
   
    public function destroy($id)
    {
        DB::table('tbl_product_exchange')->where('id', '=', $id)->delete();
        return response()->json($id);
    }
}
