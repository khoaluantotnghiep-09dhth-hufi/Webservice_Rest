<?php
//Kiểm tra class thêm vào chưa
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    //Lấy tất cả danh sách Customer
    public function index()
    {

        $result = DB::table('tbl_customer as c')
            ->join('tbl_bill as b', 'c.id', '=', 'b.id_customer')
            ->select('*')
            ->get();
        return response()->json($result);
    }
    //Tạo một Customer
    public function store($request)
    {
    }
    //Lấy một Customer theo $id
    public function show($id)
    {
    }
    //Cập nhật một Customer theo $id
    public function update($id)
    {
    }
    //Xóa một Customer theo $id
    public function destroy($id)
    {
    }
}
