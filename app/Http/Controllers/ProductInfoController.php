<?php
//Kiểm tra class thêm vào chưa
namespace App\Http\Controllers;
use Illuminate\Http\Response;
use App\Models\ProductInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ProductInfoController extends Controller
{
    public function index()
    {
        $result = ProductInfo::select('quantity', 'id')->with(['product' => function ($query) {
            $query->select('id', 'name', 'price', 'image');
        }, 'color' => function ($query) {
            $query->select('id', 'name');
        }, 'size' => function ($query) {
            $query->select('id', 'name');
        }])->get();

        return response()->json($result,200);
    }
    public function store($request)
    {
    }
    public function show($id)
    {
    }
    public function update($id)
    {
    }
    public function destroy($id)
    {
    }
}
