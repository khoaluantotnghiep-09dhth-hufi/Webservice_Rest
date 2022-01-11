<?php
//Kiểm tra class thêm vào chưa
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    //Lấy tất cả danh sách Customer theo bill
    public function getCWB()
    {
        $result = DB::table('tbl_customer as c')
            ->join('tbl_bill as b', 'c.id', '=', 'b.id_customer')
            ->select('*')
            ->orderBy('tbl_customer.id', 'DESC')
            ->get();
        return response()->json($result);
    }
    //Lấy tất cả danh sách Customer
    public function index()
    {
        $result = DB::table("tbl_customer")
            ->select('*')
            ->orderBy('tbl_customer.id', 'DESC')

            ->get();
        return response()->json($result);
    }
    public function index2()
    {
        $result = DB::table('tbl_customer')
            ->select(DB::raw('count(*) AS countCustomer'))
            ->get();
        return response()->json($result);
    }
    //Tạo một Customer
    public function store(Request $request)
    {
        $passwordMd5 = md5($request->password);

        DB::table('tbl_customer')
            ->insert(
                [
                    'id' => $request->id,
                    'name' => $request->name,
                    'address' => $request->address,
                    'phone' => $request->phone,
                    'image' => $request->image,
                    'password' =>  $passwordMd5,
                    'email' => $request->email,
                    'gender' => $request->gender,
                ]
            );
        return response()->json($request);
    }

    public function storeToAdmin(Request $request)
    {
        $passwordMd5 = md5($request->password);

        DB::table('tbl_customer')
            ->insert(
                [
                    'id' => $request->id,
                    'name' => $request->name,
                    'address' => $request->address,
                    'phone' => $request->phone,
                    'image' => $request->image,
                    'password' =>  $passwordMd5,
                    'email' => $request->email,
                    'gender' => $request->gender,
                ]
            );
        return response()->json($request);
    }
    //Lấy một Customer theo $id
    public function show($id)
    {

        $result = DB::table("tbl_customer")
            ->where("id", "=", $id)
        // ->select('tbl_customer.id')
            ->get();
        return response()->json($result);
    }
    //Cập nhật một Customer theo $id
    public function update(Request $request)
    {


        DB::table('tbl_customer')
            ->where('id', $request->id)
            ->update(
                [
                    'name' => $request->name,
                    'address' => $request->address,
                    'phone' => $request->phone,
                    'image' => $request->image,
                    'email' => $request->email,
                    'gender' => $request->gender,
                ]
            );
        return response()->json($request);
    }
    //Xóa một Customer theo $id
    public function destroy(Request $request)
    {
        // dd($request);

$id_bill= DB::table('tbl_bill')->select('tbl_bill.id')
->join('tbl_customer', 'tbl_customer.id', '=', 'tbl_bill.id_customer')
->where('tbl_customer.id',$request->id)
->get();
// $test=$id_bill[0]->id;
// dd($id_bill);
if ($id_bill==null) {
    $user=DB::table('tbl_bill_info')
    ->where("id_bill","=",$test)
    ->delete();

    DB::table('tbl_bill')->where('tbl_bill.id_customer','=',$request->id)->delete();

    DB::table('tbl_customer')->where('tbl_customer.id','=',$request->id)->delete();


}
DB::table('tbl_customer')->where('tbl_customer.id','=',$request->id)->delete();


        return response()->json($request->id);
    }

    //login
    public function login(Request $request)
    {
        $passwordMd5 = md5($request->password);
        $result = DB::table("tbl_customer")
            ->where("tbl_customer.phone", "=", $request->phone)
            ->where("tbl_customer.password", "=",  $passwordMd5)

            ->get();

        //  dd($result);

        return response()->json($result);
    }

    //Cập nhật một Customer theo $id
    public function updateScore(Request $request, $id)
    {

        $scoreCustomerByID = DB::table('tbl_customer')
            ->where('id', $id)->select('tbl_customer.score')->get();

        $scoreNew = $scoreCustomerByID[0]->score + $request->score;

        DB::table('tbl_customer')
            ->where('id', $id)
            ->update(
                [

                    'tbl_customer.score' => $scoreNew,
                ]
            );
        return response()->json($request);
    }

    public function updateDeleteScore(Request $request, $id)
    {

        $scoreCustomerByID = DB::table('tbl_customer')
            ->where('id', $id)->select('tbl_customer.score')->get();

        $scoreNew = $scoreCustomerByID[0]->score - $request->score;

        DB::table('tbl_customer')
            ->where('id', $id)
            ->update(
                [

                    'tbl_customer.score' => $scoreNew,
                ]
            );
        return response()->json($request);
    }
}
