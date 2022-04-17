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


use Illuminate\Http\Request;

$router->post('employee/create', 'EmployeeControler@create');
$router->get('employee/get/{id}', 'EmployeeControler@get');
$router->post('employee/update/{id}', 'EmployeeControler@update');
$router->post('employee/delete/{id}', 'EmployeeControler@delete');
