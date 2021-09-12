<?php
//Kiểm tra class thêm vào chưa
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //Lấy tất cả danh sách Product
    public function index()
    {

        $result = DB::table('tbl_product as p')
            ->join('tbl_category as c', 'c.id', '=', 'p.id_category')
            ->join('tbl_promotion as pp', 'pp.id', '=', 'p.id_promotion')
            ->join('tbl_product_info as ppf', 'ppf.id_product', '=', 'p.id')
            ->select('p.id', 'p.name', 'p.price', 'p.description', 'p.like_product', 'p.id_category', 'c.name', 'p.image', 'p.id_promotion', 'pp.name', 'pp.date_start', 'pp.date_end', 'pp.desciption', 'ppf.id', 'ppf.id_size', 'ppf.id_color', 'ppf.quantity as quanityAll')->orderBy('p.id')
            ->get();
        return response()->json($result);
    }
    //Tạo một Product
    public function store($request)
    {
    }
    //Lấy một Product theo $id
    public function show($id)
    {
    }
    //Cập nhật một Product theo $id
    public function update($id)
    {
    }
    //Xóa một Product theo $id
    public function destroy($id)
    {
    }
}
