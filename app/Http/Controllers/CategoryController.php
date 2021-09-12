<?php
//Kiểm tra class thêm vào chưa
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Objects;
use App\Models\Sector;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    //Lấy tất cả danh sách Category
    public function index()
    {
        // $result=Category::all();
        // $result = DB::table('tbl_category')
        //     ->join('tbl_sectors', 'tbl_sectors.id', '=', 'tbl_category.id_sectors')

        //     ->select('tbl_sectors.id','tbl_sectors.name','tbl_category.id','tbl_category.name')
        //     ->get();
        $result = DB::table('tbl_category')->select('*')->get();
        return response()->json($result);
    }
    //Tạo một Category
    public function store($request)
    {
    }
    //Lấy một Category theo $id
    public function show($id)
    {
        $result = DB::table('tbl_sectors')
            ->join('tbl_category', 'tbl_sectors.id', '=', 'tbl_category.id_sectors')
            // ->join('tbl_object','tbl_sectors.id_object','=','tbl_object.id')
            ->where('tbl_category.id_sectors', '=', $id)
            ->select('tbl_category.id', 'tbl_category.name')
            ->get();
        return response()->json($result);
    }
    //Cập nhật một Category theo $id
    public function update($id)
    {
    }
    //Xóa một Category theo $id
    public function destroy($id)
    {
    }
}
