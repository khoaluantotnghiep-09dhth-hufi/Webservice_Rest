<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class Bill_CustomerController extends Controller
{
  //Lấy tất cả danh sách  Bill_Customer
  public function index()
  {
    $result = DB::table('tbl_customer as c')
    ->join('tbl_bill as b', 'c.id', '=', 'b.id_customer')
    ->select('c.id','c.name','c.phone','c.password','b.id','b.date','b.total','b.status','b.address')
    ->get();
return response()->json($result);
  }
  //Tạo một  Bill_Customer
  public function store($request)
  {
  }
  //Lấy một  Bill_Customer theo $id
  public function show($id)
  {
  }
  //Cập nhật một  Bill_Customertheo $id
  public function update($id)
  {
  }
  //Xóa một  Bill_Customer theo $id
  public function destroy($id)
  {
  }
}
