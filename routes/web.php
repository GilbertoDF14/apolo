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

//$router->group(['middleware'=>['cors']], function() use($router){
    //$router->get('/login/{user}/{pass}', 'AuthController@login');
    
//});

$router->group(['middleware'=>['auth']], function() use($router){
    $router->get('/usuario', 'UserController@index');
    $router->get('/usuario/{user}', 'UserController@get');
    $router->post('/usuario', 'UserController@create');
    $router->put('/usuario/{user}', 'UserController@update');
    $router->delete('/usuario/{user}', 'UserController@destroy');

    $router->get('/curso', 'CursoController@index');
    $router->get('/curso/{id}', 'CursoController@get');
    $router->post('/curso', 'CursoController@create');
    $router->put('/curso/{id}', 'CursoController@update');
    $router->delete('/curso/{id}', 'CursoController@destroy');

    $router->get('/mycourse', 'MiscursosController@index');
    $router->get('/mycourse/{id_topic}', 'MiscursosController@get');
    $router->post('/mycourse', 'MiscursosController@create');
    $router->put('/mycourse/{id}', 'MiscursosController@update');
    $router->delete('/mycourse/{id}', 'MiscursosController@destroy');
});