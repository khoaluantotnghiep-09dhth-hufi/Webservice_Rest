<?php
//Kiểm tra class thêm vào chưa
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class CustomerController extends Controller
{
    //Lấy tất cả danh sách Customer theo bill
    public function getCWB()
    {
        $result = DB::table('tbl_customer as c')
            ->join('tbl_bill as b', 'c.id', '=', 'b.id_customer')
            ->select('*')
            ->get();
        return response()->json($result);
    }
    //Lấy tất cả danh sách Customer
    public function index()
    {
        $result = DB::table("tbl_customer")
        ->select('*')
        ->get();
        return response()->json($result);
    }
    //Tạo một Customer
    public function store(Request $request)
    {
        DB::table('tbl_customer')
        ->insert(
            [
                'id' => $request->id,
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'image' => $request->image,
                'password' => $request->password,
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
        ->where('id', $request->idItem)
        ->update(
            [
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'image' => $request->image,
                'password' => $request->password,
                'email' => $request->email,
                'gender' => $request->gender,
            ]
        );
        return response()->json($request);
    }
    //Xóa một Customer theo $id
    public function destroy($id)
    {
        DB::table('tbl_customer')
        ->where('id', '=', $id)
        ->delete();
        return response()->json($id);
    }
}
