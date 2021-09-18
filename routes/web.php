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

$router->get('/', 'AuthController@index');
//Category
$router->get('/categories', 'CategoryController@index');
$router->get('/categories/{id}', 'CategoryController@show');
$router->post('/categories', 'CategoryController@store');
$router->delete('/categories/{id}', 'CategoryController@destroy');
$router->put('/categories/{id}', 'CategoryController@update');
//Object
$router->get('/objects', 'ObjectsController@index');
$router->get('/objects/{id}', 'ObjectsController@index2');
// $router->get('/objects/{id}', 'ObjectsController@show');
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
$router->get('/sectors/{id}', 'SectorController@index2');
$router->post('/sectors', 'SectorController@store');
$router->delete('/sectors/{id}', 'SectorController@destroy');
$router->put('/sectors/{id}', 'SectorController@update');
//Products
$router->get('/products-category', 'ProductForCategoryController@index');
//
$router->get('/products', 'ProductController@index2');
//All Bill
$router->get('/bills', 'BillController@index');
$router->get('/bills/{id}', 'BillController@show');
$router->delete('/bills/{id}', 'BillController@destroy');
$router->put('/bills/{id}', 'BillController@update');
//Bill_Customer
$router->get('/bill-customer', 'Bill_CustomerController@index');
//Promotion
$router->get('/promotions', 'PromotionController@index');
$router->get('/promotions/{id}', 'PromotionController@show');
$router->post('/promotions', 'PromotionController@store');
$router->delete('/promotions/{id}', 'PromotionController@destroy');
$router->put('/promotions/{id}', 'PromotionController@update');
//customer
$router->get('/customers', 'CustomerController@index');
$router->get('/customers/{id}', 'CustomerController@show');
$router->post('/customers', 'CustomerController@store');
$router->put('/customers/{id}', 'CustomerController@update');
$router->delete('/customers/{id}', 'CustomerController@destroy');
//staff
$router->get('/staffs', 'StaffController@index');
$router->get('/staffs/{id}', 'StaffController@show');
$router->post('/staffs', 'StaffController@store');
$router->delete('/staffs/{id}', 'StaffController@destroy');
$router->put('/staffs/{id}', 'StaffController@update');
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
$router->post('/orders-info', 'OrderController@store');
$router->delete('/orders-info/{id}', 'OrderController@destroy');
$router->put('/orders-info/{id}', 'OrderController@update');
//run_test
$router->get('/test', function () {
    return "Test successful";
});

// $router->post('/login', 'AuthController@postLogin');
// $router->group(['middleware' => 'auth:api'], function ($app) {
//     $app->get('/test', function () {
//         return response()->json([
//             'message' => 'Hello World!',
//         ]);
//     });
// });
