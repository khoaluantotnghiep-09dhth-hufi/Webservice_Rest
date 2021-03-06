<?php
//Kiểm tra class thêm vào chưa
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //Lấy tất cả danh sách Product
    public function index()
    {
        $result = DB::table('tbl_product as product')
            ->join('tbl_category as c', 'pp.id', '=', 'product.id_category')
            ->join('tbl_promotion as pp', 'pp.id', '=', 'product.id_promotion')
            ->join('tbl_product_info as ppf', 'ppf.id_product', '=', 'product.id')
            ->select('product.id',
                'product.name_product',
                'product.price',
                'product.description',
                'product.like_product',
                'product.id_category  ',

                'c.name', 'product.image',
                'product.id_promotion',
                'pp.name', 'pp.date_start',
                'pp.date_end',
                'pp.description',
                'ppf.id',
                'ppf.id_size',
                'ppf.id_color',
                'ppf.quantity as quanityAll')->orderBy('product.id')
            ->get();
        return response()->json($result);
    }
    public function index2()
    {
        $result = DB::table('tbl_product')
            ->join('tbl_category', 'tbl_category.id', '=', 'tbl_product.id_category')
            ->join('tbl_product_info', 'tbl_product_info.id_product', '=', 'tbl_product.id')
            ->join('tbl_promotion', 'tbl_promotion.id', '=', 'tbl_product.id_promotion')
            ->join('tbl_color', 'tbl_color.id', '=', 'tbl_product_info.id_color')
            ->join('tbl_size', 'tbl_size.id', '=', 'tbl_product_info.id_size')
            ->select(
                'tbl_product.id',
                'tbl_product_info.id as id_product_info',
                'tbl_product.name',
                'tbl_product.price',
                'tbl_product.description',
                'tbl_product.like_product',

                'tbl_category.name as nameCategory',
                'tbl_product.image',
                'tbl_promotion.name as namePromotion',
                'tbl_promotion.description as percentSale',
                'tbl_product_info.quantity as quantityAllProduct',
                'tbl_size.name as nameSize',
                'tbl_color.name as nameColor'
            )
            ->distinct()

            ->orderBy('tbl_product.id')
            ->get();
        return response()->json($result);

    }
    public function index3()
    {
        //Hàm này để thêm xóa sửa sp
        $result = DB::table('tbl_product')
            ->join('tbl_category', 'tbl_category.id', '=', 'tbl_product.id_category')
        //Hàm này để thêm xóa sửa sp
            ->join('tbl_promotion', 'tbl_promotion.id', '=', 'tbl_product.id_promotion')
        //Hàm này để thêm xóa sửa sp
            ->join('tbl_product_info', 'tbl_product_info.id_product', '=', 'tbl_product.id')
            ->join('tbl_color', 'tbl_color.id', '=', 'tbl_product_info.id_color')
            ->join('tbl_size', 'tbl_size.id', '=', 'tbl_product_info.id_size')
            ->select(
                //Hàm này để thêm xóa sửa sp
                'tbl_product.id',
                //Hàm này để thêm xóa sửa sp
                'tbl_product.name',
                //Hàm này để thêm xóa sửa sp
                'tbl_product.price',
                //Hàm này để thêm xóa sửa sp
                'tbl_product.description',
                //Hàm này để thêm xóa sửa sp
                'tbl_product.like_product',
                //Hàm này để thêm xóa sửa sp

                //Hàm này để thêm xóa sửa sp
                'tbl_category.name as nameCategory',
                //Hàm này để thêm xóa sửa sp
                'tbl_product.image',
                //Hàm này để thêm xóa sửa sp
                'tbl_promotion.name as namePromotion',
                //Hàm này để thêm xóa sửa sp
                'tbl_product_info.id as id_product_info',
                'tbl_size.name as nameSize',
                'tbl_color.name as nameColor'
            )
        //Hàm này để thêm xóa sửa sp
            ->distinct('tbl_product.id')
        //Hàm này để thêm xóa sửa sp
            ->orderBy('tbl_product.id')
            // ->take(6)
        //Hàm này để thêm xóa sửa sp
            ->get();
        //Hàm này để thêm xóa sửa sp
        return response()->json($result);
        //Hàm này để thêm xóa sửa sp
    }
    //Tạo một Product
    public function store(Request $request)
    {
        DB::table('tbl_product')->insert(
            [
                "id" => $request->id,
                "name" => $request->name,
                "price" => $request->price,
                "description" => $request->description,
                "like_product" => "0",
                "dislike_product" => "0",
                "id_category" => $request->id_category,
                "image" => $request->image,
                "id_promotion" => $request->id_promotion,
            ]
        );
        return response()->json($request);
    }
    //Lấy một Product theo $id
    public function show($id)
    {
        $result = DB::table('tbl_product')
            ->join('tbl_category', 'tbl_category.id', '=', 'tbl_product.id_category')
            ->join('tbl_product_info', 'tbl_product_info.id_product', '=', 'tbl_product.id')
            ->join('tbl_promotion', 'tbl_promotion.id', '=', 'tbl_product.id_promotion')
            ->join('tbl_color', 'tbl_color.id', '=', 'tbl_product_info.id_color')
            ->join('tbl_size', 'tbl_size.id', '=', 'tbl_product_info.id_size')
            ->select(
                'tbl_product.id',
                'tbl_product.name',
                'tbl_product.price',
                'tbl_product.description',
               'tbl_product_info.id as id_product_info',
                'tbl_category.name as nameCategory',
                'tbl_product.image',
                'tbl_promotion.name as namePromotion',
                'tbl_promotion.description as percentSale',
                'tbl_product_info.quantity as quantityAllProduct',
                'tbl_size.name as nameSize',
                'tbl_color.name as nameColor'
            )
            ->where('tbl_product.id', '=', $id)
            ->orderBy('tbl_product.id')
            ->get();
        return response()->json($result);
    }
    //Cập nhật một Product theo $id
    public function update(Request $request)
    {
        DB::table('tbl_product')
            ->where('id', $request->idItem)
            ->update(
                [
                    "name" => $request->name,
                    "price" => $request->price,
                    "description" => $request->description,
                    "id_category" => $request->id_category,
                    "image" => $request->image,
                    "id_promotion" => $request->id_promotion,
                ]

            );
        return response()->json($request);
    }
    //Xóa một Product theo $id
    public function destroy($id)
    {
        DB::table('tbl_product')->where('id', '=', $id)->delete();
        return response()->json($id);
    }

    public function get10TopProductMen()
    {
        $result = DB::table('tbl_category')
            ->join('tbl_product', 'tbl_product.id_category', '=', 'tbl_category.id')
            ->join('tbl_promotion', 'tbl_promotion.id', '=', 'tbl_product.id_promotion')


            ->join('tbl_sectors', 'tbl_sectors.id', '=', 'tbl_category.id_sectors')
            ->select(
                'tbl_product.id',


                'tbl_product.name',
                'tbl_product.price',
                'tbl_product.description',
                'tbl_product.like_product',
                'tbl_promotion.description as percentSale',
                'tbl_category.name as nameCategory',
                'tbl_product.image',

            )
            ->where("tbl_sectors.id_object","object-1")

            ->orderBy('tbl_product.id', 'DESC')
            ->limit(10)
            ->get();
        return response()->json($result);

    }

    public function get10TopProductWoMen()
    {
        $result = DB::table('tbl_category')
            ->join('tbl_product', 'tbl_product.id_category', '=', 'tbl_category.id')

            ->join('tbl_promotion', 'tbl_promotion.id', '=', 'tbl_product.id_promotion')


            ->join('tbl_sectors', 'tbl_sectors.id', '=', 'tbl_category.id_sectors')
            ->select(
                'tbl_product.id',


                'tbl_product.name',
                'tbl_product.price',

                'tbl_promotion.description as percentSale',

                'tbl_category.name as nameCategory',
                'tbl_product.image',

            )
            ->where("tbl_sectors.id_object","object-2")

            ->orderBy('tbl_product.id', 'DESC')
            ->limit(10)
            ->get();
        return response()->json($result);

    }
    public function get10TopProductChild()
    {
        $result = DB::table('tbl_category')
            ->join('tbl_product', 'tbl_product.id_category', '=', 'tbl_category.id')

            ->join('tbl_promotion', 'tbl_promotion.id', '=', 'tbl_product.id_promotion')


            ->join('tbl_sectors', 'tbl_sectors.id', '=', 'tbl_category.id_sectors')
            ->select(
                'tbl_product.id',


                'tbl_product.name',
                'tbl_product.price',

                'tbl_promotion.description as percentSale',


                'tbl_category.name as nameCategory',
                'tbl_product.image',

            )
            ->where("tbl_sectors.id_object","object-3")

            ->orderBy('tbl_product.id', 'DESC')
            ->limit(10)
            ->get();
        return response()->json($result);

    }
    public function get10TopProductBaby()
    {
        $result = DB::table('tbl_category')
            ->join('tbl_product', 'tbl_product.id_category', '=', 'tbl_category.id')

            ->join('tbl_promotion', 'tbl_promotion.id', '=', 'tbl_product.id_promotion')


            ->join('tbl_sectors', 'tbl_sectors.id', '=', 'tbl_category.id_sectors')
            ->select(
                'tbl_product.id',


                'tbl_product.name',
                'tbl_product.price',

                'tbl_promotion.description as percentSale',


                'tbl_category.name as nameCategory',
                'tbl_product.image',

            )
            ->where("tbl_sectors.id_object","object-4")

            ->orderBy('tbl_product.id', 'DESC')
            ->limit(10)
            ->get();
        return response()->json($result);

    }
public function encodeURI($uri)
{
    return preg_replace_callback("{[^0-9a-z_.!~*'();,/?:@&=+$#-]}i", function ($m) {
        return sprintf('%%%02X', ord($m[0]));
    }, $uri);
}
    public function getSearchWeb($keySearch)
    {
$value=urldecode($keySearch);
        // dd($test);

        $result = DB::table('tbl_product')
            ->join('tbl_category', 'tbl_product.id_category', '=', 'tbl_category.id')
            ->join('tbl_promotion','tbl_product.id_promotion', '=', 'tbl_promotion.id')
            ->select(
                'tbl_product.id',
                'tbl_product.name',
                'tbl_product.price',
                'tbl_product.image',
                'tbl_promotion.description as percentSale',
            )
            ->where("tbl_category.name", 'like', "%{$value}%")
            ->get();
        // return response()->json(json_encode($result,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES));
        return response()->json($result);


    }

}
