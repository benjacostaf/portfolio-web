<?php

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

$router->group(['prefix'=>'fabricante'], function() use($router){
    $router->post('/nuevo','FabricanteController@register');
    $router->get('/','FabricanteController@obtenerFabricantes');
    $router->get('/{id_fabricante}', 'FabricanteController@obtenerFabricanteId');
});

$router->group(['prefix'=>'tipo'], function() use($router){
    $router->post('/nuevo','TipoController@register');
    $router->get('/', 'TipoController@obtenerTipos');
    $router->get('/{id_tipo}','TipoController@obtenerTipoId');
    $router->get('/filters/{id_tipo}', 'TipoController@obtenerFiltros');
});

$router->group(['prefix'=>'categoria'], function() use($router){
    $router->post('/nuevo','CategoriaController@register');
    $router->get('/', 'CategoriaController@obtenerCategorias');
    $router->get('/{id_categoria}','CategoriaController@obtenerCategoriaId');
});

$router->group(['prefix'=>'producto'], function() use($router){
    $router->post('/nuevo','ProductoController@register');
    $router->get('/', 'ProductoController@obtenerProductos');
    $router->get('/{id}','ProductoController@obtenerProductoId');
    $router->get('/full/{id}','ProductoController@obtenerFullProducto');
    $router->get('/categoria/{id_categoria}','ProductoController@obtenerProductoCategoria');
});

$router->group(['prefix'=>'mail'], function() use($router){
    $router->post('/new', 'EmailController@register');
});