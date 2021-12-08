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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'usuario'], function($router) {
    $router->group(['prefix' => '{id:[\d]+}'], function($router) {
        $router->get('/', 'UsersController@get');
        $router->put('/', 'UsersController@update');
        $router->delete('/', 'UsersController@delete');
    });

    $router->get('/', 'UsersController@index');
    $router->post('/', 'UsersController@store');
});
