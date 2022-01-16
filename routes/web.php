<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
 */
//Rating info
$router->get('/rating-info', 'RatingInfoController@index');
$router->get('/rating-info/{id}', 'RatingInfoController@show');
$router->post('/rating-info', 'RatingInfoController@store');
$router->delete('/rating-info/{id}', 'RatingInfoController@destroy');
$router->put('/rating-info/{id}', 'RatingInfoController@update');
//raing
$router->get('/rating', 'RatingController@index');
$router->get('/rating/{id}', 'RatingController@show');
$router->post('/rating', 'RatingController@store');
$router->delete('/rating/{id}', 'RatingController@destroy');
$router->put('/rating/{id}', 'RatingController@update');

$router->get('/', 'AuthController@index');
//Banner
$router->get('/banners', 'BannerController@index');
$router->post('/get-update-banner', 'BannerController@show');
$router->post('/banners', 'BannerController@store');
$router->post('/delete-banner', 'BannerController@destroy');
$router->put('/banners/{id}', 'BannerController@update');
//Category
$router->get('/categories', 'CategoryController@index');
$router->get('/categories/{id}', 'CategoryController@show');
$router->post('/categories', 'CategoryController@store');
$router->delete('/categories/{id}', 'CategoryController@destroy');
$router->put('/categories/{id}', 'CategoryController@update');
//Object
$router->get('/objects', 'ObjectsController@index');
$router->get('/objects/{id}', 'ObjectsController@show');
$router->post('/objects', 'ObjectsController@store');
$router->put('/objects/{id}', 'ObjectsController@update');
$router->delete('/objects/{id}', 'ObjectsController@destroy');
//Color
$router->get('/color', 'ColorController@index');
$router->get('/color/{id}', 'ColorController@show');
$router->post('/color', 'ColorController@store');
$router->delete('/color/{id}', 'ColorController@destroy');
$router->put('/color/{id}', 'ColorController@update');
//Size
$router->get('/size', 'SizeController@index');
$router->get('/size/{id}', 'SizeController@show');
$router->post('/size', 'SizeController@store');
$router->delete('/size/{id}', 'SizeController@destroy');
$router->put('/size/{id}', 'SizeController@update');
//Sector
$router->get('/sectors', 'SectorController@index');
$router->get('/sectors/{id}', 'SectorController@show');
// $router->get('/sectors/{id}', 'SectorController@index2');
$router->post('/sectors', 'SectorController@store');
$router->delete('/sectors/{id}', 'SectorController@destroy');
$router->put('/sectors/{id}', 'SectorController@update');
//Products of Category
$router->get('/products-category', 'ProductForCategoryController@index');
$router->get('/products-category/{id_Category}', 'ProductForCategoryController@showCategory');
$router->get('/product-sizes/{id}', 'ProductForCategoryController@show');

//product info
$router->get('/product-info-mobile/{id}', 'ProductInfoController@showProductInfoByIdProduct');
$router->get('/product-info-color-size-mobile/{id}', 'ProductInfoController@showProductInfoColorByIdProduct');
$router->post('/product-info', 'ProductInfoController@store');
$router->get('/product-info/{id}', 'ProductInfoController@index2');
$router->get('/product-info', 'ProductInfoController@index');
$router->delete('/product-info/{id}', 'ProductInfoController@destroy');
$router->put('/product-info/{id}', 'ProductInfoController@update');
$router->get('/product-info2/{id}', 'ProductInfoController@show');
//Product
// $router->get('/products', 'ProductController@index2');
$router->get('/products/{id}', 'ProductController@show');
$router->get('/products-top4-men', 'ProductController@get10TopProductMen');
$router->get('/products-top4-women', 'ProductController@get10TopProductWoMen');
$router->get('/products-top4-child', 'ProductController@get10TopProductChild');
$router->get('/products-top4-baby', 'ProductController@get10TopProductBaby');

$router->get('/web-search/{keySearch}', 'ProductController@getSearchWeb');

$router->post('/products', 'ProductController@store');
$router->get('/products', 'ProductController@index3');
$router->delete('/products/{id}', 'ProductController@destroy');
$router->put('/products/{id}', 'ProductController@update');

//Product admin
$router->get('/products-mobile/{id}', 'ProductAdminController@showByIdCategory');
$router->get('/products-mobile-cart/{id}', 'ProductAdminController@showProductByID');

$router->get('/products-admin/{id}', 'ProductAdminController@show');
$router->post('/products-admin', 'ProductAdminController@store');
$router->get('/products-admin', 'ProductAdminController@index');
$router->get('/products-adminMobile', 'ProductAdminController@indexMobile');
$router->delete('/products-admin/{id}', 'ProductAdminController@destroy');
$router->put('/products-admin/{id}', 'ProductAdminController@update');

$router->get('/products-adminMobileSearch', 'ProductAdminController@indexMobileSearch');
//All Bill for admin

$router->get('/bills', 'BillController@index');
$router->get('/bills-delivered', 'BillController@indexDelivered');
$router->get('/bills-delivering', 'BillController@indexDelivering');
$router->get('/bills-waite-take', 'BillController@indexWaitTake');
$router->get('/bills-exchange-request', 'BillController@indexExchangeRequest');
$router->get('/bills-confirm/{id}', 'BillController@showBillConfirm');
$router->get('/bills/{id}', 'BillController@show');
$router->post('/bills-wait', 'BillController@showWaitBill');
$router->put('/bills-exchange-update', 'BillController@updateStatusToExchange');
$router->get('/bills-detail/{id}', 'BillController@DetailOrder');

$router->delete('/bills/{id}', 'BillController@destroy');
$router->put('/bills/{id}', 'BillController@update');
//Bill_Customer
$router->get('/bill-customer', 'Bill_CustomerController@index');
$router->get('/bill-customer/{id}', 'Bill_CustomerController@show');

$router->post('/bill-customer', 'Bill_CustomerController@store');
//Bill_Info
$router->get('/bill-info-customer', 'BillInfoController@index');
$router->post('/bill-info-customer', 'BillInfoController@store');
$router->post('/bill-info-customer-mobile', 'BillInfoController@store_mobile');
//Promotion
$router->get('/promotions', 'PromotionController@index');
$router->get('/promotions/{id}', 'PromotionController@show');
$router->post('/promotions', 'PromotionController@store');
$router->delete('/promotions/{id}', 'PromotionController@destroy');
$router->put('/promotions/{id}', 'PromotionController@update');
//customer
$router->get('/customers', 'CustomerController@index');

$router->put('/customer-score/{id}', 'CustomerController@updateScore');
$router->get('/customers/{id}', 'CustomerController@show');
$router->post('/customers', 'CustomerController@store');
$router->post('/customers_client', 'CustomerClientController@store');
$router->put('/customers/{id}', 'CustomerController@update');
$router->put('/customers_client/{id}', 'CustomerClientController@update');
$router->delete('/delete-customers/{id}', 'CustomerController@destroy');
//staff
$router->post('/login-admin', 'StaffController@login');
$router->get('/staffs', 'StaffController@index');
$router->get('/staffs/{id}', 'StaffController@show');
$router->post('/staffs', 'StaffController@store');
$router->delete('/staffs/{id}', 'StaffController@destroy');
$router->put('/staffs/{id}', 'StaffController@update');
$router->put('/staff-account/{id}', 'StaffController@updateAccount');
$router->put('/staffs-profile/{id}', 'StaffController@updateProfile');
$router->put('/staffs-password/{id}', 'StaffController@updatePassword');
//news
$router->get('/news', 'NewsController@index');
$router->get('/news/{id}', 'NewsController@show');
$router->post('/news', 'NewsController@store');
$router->delete('/news/{id}', 'NewsController@destroy');
$router->put('/news/{id}', 'NewsController@update');
//order
$router->get('/orders', 'OrderController@index');
$router->get('/orders/{id}', 'OrderController@show');
$router->post('/orders', 'OrderController@store');
$router->delete('/orders/{id}', 'OrderController@destroy');
$router->put('/orders/{id}', 'OrderController@update');
// order info
$router->get('/orders-info', 'OrderInfoController@index');
$router->get('/orders-info/{id}', 'OrderInfoController@show');
$router->post('/orders-info', 'OrderInfoController@store');
$router->delete('/orders-info/{id}', 'OrderInfoController@destroy');
$router->put('/orders-info/{id}', 'OrderInfoController@update');
//import product
$router->get('/orders-import', 'OrderController@index2');
$router->get('/import-product', 'ImportController@index');
$router->get('/import-product/{id}', 'ImportController@show');
$router->post('/import-product', 'ImportController@store');
$router->put('/import-product/{id}', 'ImportController@update');
$router->delete('/import-product/{id}', 'ImportController@destroy');
//import Info
$router->get('/orders-info-quantity/{id}', 'OrderInfoController@show3');
$router->get('/product-info-order-info/{id}', 'ProductInfoController@show2');
$router->get('/orders-info-import/{id}', 'OrderInfoController@show2');
$router->get('/orders-info-byid', 'OrderInfoController@index2');
$router->get('/import-info', 'ImportInfoController@index');
$router->get('/import-info/{id}', 'ImportInfoController@show');
$router->post('/import-info', 'ImportInfoController@store');
$router->put('/import-info/{id}', 'ImportInfoController@update');
$router->delete('/import-info/{id}', 'ImportInfoController@destroy');
$router->put('/product-info-import/{id}', 'ProductInfoController@update2');

//Exchange product
$router->get('/exchange', 'ExchangeController@index');
$router->get('/exchange/{id}', 'ExchangeController@show');
$router->post('/exchange', 'ExchangeController@store');
$router->delete('/exchange/{id}', 'ExchangeController@destroy');
$router->put('/exchange/{id}', 'ExchangeController@update');
$router->put('/exchange-bill-status/{id}', 'BillExchangeController@updateExchange');

//Notification
$router->get('/notifications', 'NotificationController@index');
$router->get('/reset-notifications', 'NotificationController@reset');

$router->post('/notifications', 'NotificationController@store');
$router->delete('/notifications/{id}', 'NotificationController@destroy');


//acb
$router->get('/exchange-bill-info', 'BillExchangeController@index');
$router->get('/exchange-product-info/{id}', 'BillExchangeController@show');
$router->put('/bill-info-exchange/{id}', 'BillInfoController@update');
//run_test
//statical
$router->get('/bills-total', 'BillController@index3');
$router->get('/bills-total-quantity', 'BillController@index4');
$router->get('/staff-count', 'StaffController@index2');
$router->get('/customer-count', 'CustomerController@index2');
$router->get('/product-info-count', 'ProductInfoController@index3');
$router->get('/order-info-count', 'OrderInfoController@countOrder');
$router->get('/import-info-count', 'ImportInfoController@countImport');
$router->get('/order-sum-date', 'OrderController@sumQuantityByDate');
$router->get('/import-sum-date', 'ImportController@sumQuantityByDate');
$router->get('/count-status-bill', 'BillController@countStatus0Bill');
$router->get('/count-status-product', 'ProductInfoController@countStatusProduct');
$router->get('/test', function () {
    return "Test successful";
});

$router->post('/login-web', 'CustomerController@login');
$router->post('/login-admin', 'StaffController@login');

// $router->post('/login', 'AuthController@postLogin');
// $router->group(['middleware' => 'auth:api'], function ($app) {
//     $app->get('/test', function () {
//         return response()->json([
//             'message' => 'Hello World!',
//         ]);
//     });
// });
