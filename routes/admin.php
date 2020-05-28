<?php

//use Illuminate\Routing\Route;

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

    Config::set('auth.defaults', 'admin');

    Route::group(['middleware' => 'guest:admin'], function () {
        Route::get('login', 'AdminAuth@login');
        Route::post('login', 'AdminAuth@dologin');
        Route::get('forgot/password', 'AdminAuth@forgot_password');
        Route::post('forgot/password', 'AdminAuth@forgot_password_post');
        Route::get('reset/password/{token}', 'AdminAuth@reset_password');
        Route::post('reset/password/{token}', 'AdminAuth@reset_password_final');
    });


    Route::group(['middleware' => 'admin:admin'], function () {
        Route::resource('admin', 'AdminController');
        Route::resource('users', 'UsersController');
        Route::resource('countries', 'CountriesController');
        Route::resource('cities', 'CitiesController');
        Route::resource('states', 'StatesController');
        Route::resource('departments', 'DepartmentsController');
        Route::resource('trademarks', 'TradeMarksController');
        Route::resource('manufacturers', 'ManufacturersController');
        Route::resource('shipping', 'ShippingController');
        Route::resource('malls', 'MallsController');
        Route::resource('colors', 'ColorsController');
        Route::resource('sizes', 'SizesController');
        Route::resource('weights', 'WeightsController');
        Route::resource('products', 'ProductsController');


        Route::delete('admin/destroy/all', 'AdminController@multi_delete');
        Route::delete('users/destroy/all', 'UsersController@multi_delete');
        Route::delete('countries/destroy/all', 'countriesController@multi_delete');
        Route::delete('cities/destroy/all', 'CitiesController@multi_delete');
        Route::delete('states/destroy/all', 'StatesController@multi_delete');
        Route::delete('departments/destroy/all', 'DepartmentsController@multi_delete');
        Route::delete('trademarks/destroy/all', 'TradeMarksController@multi_delete');
        Route::delete('manufacturers/destroy/all', 'ManufacturersController@multi_delete');
        Route::delete('shipping/destroy/all', 'ShippingController@multi_delete');
        Route::delete('malls/destroy/all', 'MallsController@multi_delete');
        Route::delete('colors/destroy/all', 'ColorsController@multi_delete');
        Route::delete('sizes/destroy/all', 'SizesController@multi_delete');
        Route::delete('weights/destroy/all', 'WeightsController@multi_delete');
        Route::delete('products/destroy/all', 'ProductsController@multi_delete');
        Route::post('upload/image/{pid}', 'ProductsController@upload_file');

        Route::get('/', function () {
            return view('admin.home');
        });
        Route::any('logout', 'AdminAuth@logout');
        Route::get('settings', 'Settings@setting');
        Route::post('settings', 'Settings@setting_save');




    });
    Route::get('lang/{lang}', function ($lang) {
        session()->has('lang') ? session()->forget('lang') : '';
        $lang == 'ar' ? session()->put('lang', 'ar') : session()->put('lang', 'en');
        return back();
    });
});
