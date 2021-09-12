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


//Object
$router->get('/objects', 'ObjectsController@index');
$router->get('/objects/{id}', 'ObjectsController@show');

//Sector
$router->get('/sectors', 'SectorController@index');

//User
$router->get('/users', 'CustomerController@index');

//Products
$router->get('/products', 'ProductController@index');




// $router->post('/login', 'AuthController@postLogin');
// $router->group(['middleware' => 'auth:api'], function ($app) {
//     $app->get('/test', function () {
//         return response()->json([
//             'message' => 'Hello World!',
//         ]);
//     });
// });

