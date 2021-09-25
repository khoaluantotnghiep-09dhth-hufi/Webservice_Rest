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
            ->orderBy('tbl_customer.name')
            ->get();
        return response()->json($result);
    }
    public function index2($id)
    {
        $result = DB::table('tbl_product_info')
            ->join('tbl_color', 'tbl_color.id', '=', 'tbl_product_info.id_color')
            ->join('tbl_size', 'tbl_size.id', '=', 'tbl_product_info.id_size')
            ->join('tbl_product', 'tbl_product.id', '=', 'tbl_product_info.id_product')
            ->select(
                'tbl_product_info.id',
                'tbl_product.name',
                'tbl_product_info.quantity',
                'tbl_size.name as nameSize',
                'tbl_color.name as nameColor',
                'tbl_product.image',
            )
            ->where('tbl_product.id', '=', $id)
            ->orderBy('tbl_product.name')
            ->get();
        return response()->json($result);
    }
    public function store(Request $request)
    {
        DB::table('tbl_product_info')->insert(
            [
                "id" => $request->id,
                "id_product" => $request->id_product,
                "id_size" => $request->id_size,
                "id_color" => $request->id_color,
                "quantity" => $request->quantity,
            ]
        );
        return response()->json($request);
    }
    public function show($id)
    {
        $result = DB::table('tbl_product_info')
            ->join('tbl_color', 'tbl_color.id', '=', 'tbl_product_info.id_color')
            ->join('tbl_size', 'tbl_size.id', '=', 'tbl_product_info.id_size')
            ->join('tbl_product', 'tbl_product.id', '=', 'tbl_product_info.id_product')
            ->select(
                'tbl_product_info.id',
                'tbl_product.name',
                'tbl_product_info.quantity',
                'tbl_size.name as nameSize',
                'tbl_color.name as nameColor',
                'tbl_product.image',
            )
            ->where('tbl_product_info.id', '=', $id)
            ->orderBy('tbl_product.name')
            ->get();
        return response()->json($result);
    }
    public function show2($id)
    {
        $result = DB::table('tbl_product_info')
            ->join('tbl_order_info', 'tbl_order_info.id_product_info', '=', 'tbl_product_info.id')
            ->join('tbl_color', 'tbl_color.id', '=', 'tbl_product_info.id_color')
            ->join('tbl_size', 'tbl_size.id', '=', 'tbl_product_info.id_size')
            ->join('tbl_product', 'tbl_product.id', '=', 'tbl_product_info.id_product')
            ->select(
                'tbl_product_info.id',
                'tbl_product.name',
                'tbl_product_info.quantity',
                'tbl_size.name as nameSize',
                'tbl_color.name as nameColor',
                'tbl_product.image',
            )
            ->where('tbl_order_info.id', '=', $id)
            ->get();
        return response()->json($result);
    }
    public function update(Request $request)
    {
        DB::table('tbl_product_info')
            ->where('id', $request->idItem)
            ->update(
                [
                    "id_size" => $request->id_size,
                    "id_color" => $request->id_color,
                    "quantity" => $request->quantity,
                ]

            );
        return response()->json($request);
    }
    public function update2(Request $request)
    {
        DB::table('tbl_product_info')
            ->where('id', $request->idItem)
            ->update(
                [
                    "quantity" => $request->quantity,
                ]

            );
        return response()->json($request);
    }
    public function destroy($id)
    {
        DB::table('tbl_product_info')->where('id', '=', $id)->delete();
        return response()->json($id);
    }
}
