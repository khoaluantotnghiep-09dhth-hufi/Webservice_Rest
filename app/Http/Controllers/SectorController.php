<?php
//Kiểm tra class thêm vào chưa
namespace App\Http\Controllers;

use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SectorController extends Controller
{
    //Lấy tất cả danh sách Sector
    public function index()
    {
        // $result = Sector::all();
        $result = DB::table('tbl_sectors')->select('*')->get();
        return response()->json($result);
    }
    //Tạo một Sector
    public function store($request)
    {
    }
    //Lấy một Sector theo $id
    public function show($id)
    {
    }
    //Cập nhật một Sector theo $id
    public function update($id)
    {
    }
    //Xóa một Sector theo $id
    public function destroy($id)
    {
    }
}
