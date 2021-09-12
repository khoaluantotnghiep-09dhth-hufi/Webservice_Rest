<?php
//Kiểm tra class thêm vào chưa
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Objects;
use App\Models\Sector;
use Illuminate\Support\Facades\DB;

class ObjectsController extends Controller
{
    //Lấy tất cả danh sách Object
    public function index()
    {
        // $result=Sector::with(['object','category'])->get();
        $result = DB::table('tbl_object')

            ->select('*')
            ->get();
        return response()->json($result);
    }
    //Tạo một Object
    public function store($request)
    {
    }
    //Lấy một Object theo $id
    public function show($id)
    {
        $result = DB::table('tbl_sectors')
            // ->join('tbl_category','tbl_sectors.id','=','tbl_category.id_sectors')
            ->join('tbl_object', 'tbl_sectors.id_object', '=', 'tbl_object.id')
            ->where('tbl_sectors.id_object', '=', $id)
            ->select('tbl_sectors.id', 'tbl_sectors.name')
            ->get();
        header("Content-type:application/json");
        header("Content-type:text/html;charset=utf8");
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
        return json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }
    //Cập nhật một Object theo $id
    public function update($id)
    {
    }
    //Xóa một Object theo $id
    public function destroy($id)
    {
    }
}
