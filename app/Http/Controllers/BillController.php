<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillController extends Controller
{
    //Lấy tất cả danh sách Bill
    public function index()
    {
        $result = DB::table('tbl_bill')->select('*')
        ->orderBy('tbl_bill.order_date', 'DESC')
        ->get();
        return response()->json($result);
    }
    public function indexDelivered()
    {
        $result = DB::table('tbl_bill')->select('*')
            ->where('status', '=', '4')
            ->get();
        return response()->json($result);
    }
    public function indexDelivering()
    {
        $result = DB::table('tbl_bill')->select('*')
            ->where('status', '=', '3')
            ->get();
        return response()->json($result);
    }
    public function indexWaitTake()
    {
        $result = DB::table('tbl_bill')->select('*')
            ->where('status', '=', '2')
            ->get();
        return response()->json($result);
    }
    public function indexExchangeRequest()
    {
        $result = DB::table('tbl_bill')->select('*')
            ->where('status', '=', '5')
            ->get();
        return response()->json($result);
    }
    public function index2()
    {
        $result = DB::table('tbl_bill')
            ->select('*')
            ->get();
        return response()->json($result);
    }
    public function index3()
    {
        $result = DB::table('tbl_bill')->select(
            DB::raw("(sum(total)) as sumTotal"),
            DB::raw("order_date")
        )
            ->orderBy('order_date')
            ->groupBy(DB::raw("order_date"))
            ->get();

        return response()->json($result);
    }
    public function index4()
    {
        $result = DB::table('tbl_bill')
            ->select(
                DB::raw("(sum(total_quantity)) as sumTotalQuantity"),
                DB::raw("order_date")
            )
            ->orderBy('order_date')
            ->groupBy(DB::raw("order_date"))
            ->get();
        return response()->json($result);
    }
    public function countStatus0Bill()
    {
        $result = DB::table('tbl_bill')
            ->select(
                DB::raw("(count(status)) as countStatus"),
            )
            ->where('status', '=', 0)
            ->get();
        return response()->json($result);
    }
    //Tạo một Bill
    public function store(Request $request)
    {

    }
    //Lấy một Bill theo $id
    public function show($id)
    {
        $result = DB::table('tbl_bill')
            ->join('tbl_bill_info', 'tbl_bill_info.id_bill', '=', 'tbl_bill.id')
            ->join('tbl_product_info', 'tbl_product_info.id', '=', 'tbl_bill_info.id_product_info')
            ->join('tbl_product', 'tbl_product.id', '=', 'tbl_product_info.id_product')
            ->join('tbl_color', 'tbl_color.id', '=', 'tbl_product_info.id_color')
            ->join('tbl_size', 'tbl_size.id', '=', 'tbl_product_info.id_size')
            ->select(
                'tbl_product.image',
                'tbl_bill_info.quantity',
                'tbl_product.name',
                'tbl_bill.status',
                'tbl_color.name as nameColor',
                'tbl_size.name as nameSize',
                'tbl_product.id',
            )
            ->where('id_customer', '=', $id)
            ->where('status', '=', 1)
         
            ->get();
        return response()->json($result);
    }
    public function showWaitBill(Request $request)
    {
        $result = DB::table('tbl_bill')
            ->join('tbl_bill_info', 'tbl_bill_info.id_bill', '=', 'tbl_bill.id')
            ->join('tbl_product_info', 'tbl_product_info.id', '=', 'tbl_bill_info.id_product_info')
            ->join('tbl_product', 'tbl_product.id', '=', 'tbl_product_info.id_product')
            ->join('tbl_color', 'tbl_color.id', '=', 'tbl_product_info.id_color')
            ->join('tbl_size', 'tbl_size.id', '=', 'tbl_product_info.id_size')
            ->join('tbl_customer', 'tbl_customer.id', '=', 'tbl_bill.id_customer')
            ->select(
                'tbl_product.image',
                'tbl_bill_info.quantity',
                'tbl_product.name',
                'tbl_bill.status',
                'tbl_color.name as nameColor',
                'tbl_size.name as nameSize',
                'tbl_product.id as idProduct',
                'tbl_bill.id',
                'tbl_bill.id_customer'
            )
            ->where('tbl_bill.id_customer', '=', $request->id_user)
            ->get();
        return response()->json($result);
    }
    public function updateStatusToExchange(Request $request)
    {
$statusID=5;
       $result= DB::table('tbl_bill')
            ->where('tbl_bill.id', $request->id)
            ->update(
                [
                    'status'=>$statusID
                ]

            );

        return response()->json($request);
    }
    public function showDelivered(Request $request)
    {
        $result = DB::table('tbl_bill')
            ->join('tbl_bill_info', 'tbl_bill_info.id_bill', '=', 'tbl_bill.id')
            ->join('tbl_product_info', 'tbl_product_info.id', '=', 'tbl_bill_info.id_product_info')
            ->join('tbl_product', 'tbl_product.id', '=', 'tbl_product_info.id_product')
            ->join('tbl_color', 'tbl_color.id', '=', 'tbl_product_info.id_color')
            ->join('tbl_size', 'tbl_size.id', '=', 'tbl_product_info.id_size')
            ->join('tbl_customer', 'tbl_customer.id', '=', 'tbl_bill.id_customer')
            ->select(
                'tbl_product.image',
                'tbl_bill_info.quantity',
                'tbl_product.name',
                'tbl_bill.status',
                'tbl_color.name as nameColor',
                'tbl_size.name as nameSize',
                'tbl_product.id',
                'tbl_bill.id_customer'
            )
            ->where('tbl_bill.id_customer', '=', $request->id_customer)
            ->where('tbl_bill.status', '=', 4)
            ->get();
        return response()->json($result);
    }
    public function showDelivering(Request $request)
    {
        $result = DB::table('tbl_bill')
            ->join('tbl_bill_info', 'tbl_bill_info.id_bill', '=', 'tbl_bill.id')
            ->join('tbl_product_info', 'tbl_product_info.id', '=', 'tbl_bill_info.id_product_info')
            ->join('tbl_product', 'tbl_product.id', '=', 'tbl_product_info.id_product')
            ->join('tbl_color', 'tbl_color.id', '=', 'tbl_product_info.id_color')
            ->join('tbl_size', 'tbl_size.id', '=', 'tbl_product_info.id_size')
            ->join('tbl_customer', 'tbl_customer.id', '=', 'tbl_bill.id_customer')
            ->select(
                'tbl_product.image',
                'tbl_bill_info.quantity',
                'tbl_product.name',
                'tbl_bill.status',
                'tbl_color.name as nameColor',
                'tbl_size.name as nameSize',
                'tbl_product.id',
                'tbl_bill.id_customer'
            )
            ->where('tbl_bill.id_customer', '=', $request->id_customer)
            ->where('tbl_bill.status', '=', 3)
            ->get();
        return response()->json($result);
    }
    //Cập Nhật một Bill theo $id
    public function update(Request $request)
    {
        DB::table('tbl_bill')
            ->where('id', $request->id)
            ->update(
                [
                    'status' => (int) $request->status,

                    'delivery_date' => $request->delivery_date,
                    'id_staff' => $request->id_staff,

                ]

            );

        return response()->json($request);
    }
    //Xóa một Size theo $id
    public function TrimTrailingZeroes($nbr)
    {
        return strpos($nbr, '.') !== false ? rtrim(rtrim($nbr, '0'), '.') : $nbr;
    }

    public function destroy($id)
    {
        // Lấy Score của Khách
        $scoreCustomerByID = DB::table('tbl_bill')
            ->join('tbl_customer', 'tbl_customer.id', '=', 'tbl_bill.id_customer')
            ->where('tbl_bill.id', $id)->select('tbl_customer.score')->get();

// Lấy total money của cái đơn muốn huỷ
        $totalMoneyBillNow = DB::table('tbl_bill')
            ->where('tbl_bill.id', $id)->select('tbl_bill.total')->get();
// Xử lý chuỗ do bị vd: 1001.0
        $trimFormatScore = strpos($totalMoneyBillNow[0]->total, '.') !== false ? rtrim(rtrim($totalMoneyBillNow[0]->total, '0'), '.') : $totalMoneyBillNow[0]->total;

//Tính Điểm của cái đơn muốn huỷ
        $scoreCalculator = ceil($trimFormatScore / 10000);
// Kết quả điểm đã ra cần Update
        $scoreBillNow = $scoreCustomerByID[0]->score - $scoreCalculator;

        $result = DB::table('tbl_bill')
            ->join('tbl_customer', 'tbl_customer.id', '=', 'tbl_bill.id_customer')
            ->where('tbl_bill.id', $id)
            ->update(
                [

                    'tbl_customer.score' => (int) $scoreBillNow,
                ]
            );
//debuge trong PostMan khi request API : dd($example),var_dump($example)
// dd((int)$scoreBillNow);
// XOá sản phẩm xong bill-info trước
        DB::table('tbl_bill_info')->where('id_bill', '=', $id)->delete();
        //Xoá Bill
        DB::table('tbl_bill')->where('id', '=', $id)->delete();
        return response()->json($id);
    }
    //Lấy một Bill Info theo $id
    public function DetailOrder($id)
    {
        $result = DB::table('tbl_bill')
            ->join('tbl_bill_info', 'tbl_bill_info.id_bill', '=', 'tbl_bill.id')
            ->join('tbl_product_info', 'tbl_product_info.id', '=', 'tbl_bill_info.id_product_info')
            ->join('tbl_product', 'tbl_product.id', '=', 'tbl_product_info.id_product')
            ->join('tbl_color', 'tbl_color.id', '=', 'tbl_product_info.id_color')
            ->join('tbl_size', 'tbl_size.id', '=', 'tbl_product_info.id_size')
            ->select(
                'tbl_product.image',
                'tbl_bill_info.quantity',
                'tbl_bill_info.into_money',
                'tbl_product.name',
                'tbl_product.price as priceProduct',

                'tbl_color.name as nameColor',
                'tbl_size.name as nameSize',
                'tbl_product.name',
            )
            ->where('tbl_bill.id', '=', $id)

            ->get();
        return response()->json($result);
    }

    //Lấy một Bill theo $id
    public function showBillConfirm($id)
    {
        $result = DB::table('tbl_bill')

            ->select(
                'tbl_bill.id',
                'tbl_bill.status',
                'tbl_bill.order_date',
                'tbl_bill.delivery_date',
                'tbl_bill.total',
                'tbl_bill.id_customer',

            )
            ->where('id', '=', $id)

            ->get();
        return response()->json($result);
    }

    public function removeZeroDigitsFromDecimal($number, $decimal_sep = '.')
    {
        $explode_num = explode($decimal_sep, $number);
        if (is_array($explode_num) && isset($explode_num[count($explode_num) - 1]) && intval($explode_num[count($explode_num) - 1]) === 0) {
            unset($explode_num[count($explode_num) - 1]);
            $number = implode($decimal_sep, $explode_num);
        }
        unset($explode_num);
        return (string) $number;
    }
}
