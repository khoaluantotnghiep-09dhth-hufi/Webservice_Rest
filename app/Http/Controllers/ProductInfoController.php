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
    public function store(Request $request)
    {
        DB::table('tbl_product_info')->insert(
            [
                "id" => $request->id,
                "id_product" => $request->id_product,
                "id_size" => $request->id_size,
                "id_color" => $request->id_color,
                "quantity" => $request->quantity
            ]
        );
        return response()->json($request);
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
