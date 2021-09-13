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
$router->get('/objects/{id}', 'ObjectsController@show');
//Color
$router->get('/color', 'ColorController@index');
$router->post('/color', 'ColorController@store');
$router->delete('/color/{id}', 'ColorController@destroy');
$router->put('/color/{id}', 'ColorController@update');
//Sector
$router->get('/sectors', 'SectorController@index');

//User
$router->get('/users', 'CustomerController@index');

//Products
$router->get('/products', 'ProductController@index');

//Bill_Customer
$router->get('/bill-customer', 'Bill_CustomerController@index');

//run_test
$router->get('/test', function(){
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

