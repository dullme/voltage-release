<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    //公司
    $router->resource('companies', CompanyController::class);
    $router->get('company-list', "CompanyController@getCompany");

    //公司联系人
    $router->resource('company-contacts', CompanyContactController::class);

    //项目
    $router->resource('projects', ProjectController::class);
    $router->get('projects/info/{id}', "ProjectController@info");
    $router->get('projects/typical/add/{id}', 'ProjectController@addTypical');


    //零件
    $router->resource('components', ComponentController::class);

    //太阳能板
    $router->resource('solar-panels', SolarPanelController::class);

    //支架种类
    $router->resource('brackets', BracketController::class);

    //产品型号
    $router->resource('specifications', SpecificationController::class);
    $router->get('specification-list', "SpecificationController@getSpecification");

    //产品
    $router->resource('items', ItemController::class);

    //组合
    $router->resource('combinations', CombinationController::class);
    $router->get('combination-list', "CombinationController@getCombinationList");

    $router->get('/', 'HomeController@index')->name('home');


    //线束设计
    $router->resource('harnesses', HarnessController::class);

});
