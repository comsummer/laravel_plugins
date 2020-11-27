<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->get("/te", function (){
        return "nnn";
    });
    $router->get("/tt", "JobTesController@tt");
    $router->get("/c", "JobTesController@c");
    $router->get("/jobHello", "JobTesController@customQueueJob");
});
