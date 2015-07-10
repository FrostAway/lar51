<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
Route::get('/home', function() {
    auth()->logout();
});

Route::group(['prefix' => 'bai-viet', 'namespace' => 'Admin'], function() {
    Route::get('/{slug}-{id}/view', ['as' => 'post.view', 'uses' => 'PostController@show']);
});
Route::group(['prefix' => 'trang', 'namespace' => 'Admin'], function() {
    Route::get('/{id}/view', ['as' => 'page.view', 'uses' => 'PageController@show']);
});
Route::group(['prefix' => 'danh-muc', 'namespace' => 'Admin'], function() {
    Route::get('/{id}/view', ['as' => 'cat.view', 'uses' => 'CategoryController@show']);
});

Route::get('auth/login', ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);
Route::get('auth/register', ['as' => 'auth.register', 'uses' => 'Auth\AuthController@getRegister']);
Route::post('auth/create', ['as' => 'auth.create', 'uses' => 'Auth\AuthController@postRegister']);
Route::post('auth/login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('logout', ['as' => 'logout', 'middleware' => 'login', 'uses' => 'Auth\AuthController@getLogout']);


Route::group(['prefix' => 'quanly', 'middleware' => 'login'], function() {
    Route::get('/', ['as' => 'admin', 'uses' => 'Admin\AdminController@index']);
    Route::post('/admin-ajax', ['as' => 'admin.ajax', 'uses' => 'Admin\AdminController@admin_ajax']);
    Route::group(['prefix' => 'user', 'namespace' => 'Auth'], function() {
        Route::get('/', ['as' => 'admin.user', 'uses' => 'AuthController@index']);
        Route::get('/create', ['as' => 'admin.user.create', 'uses' => 'AuthController@getCreate']);
        Route::post('/store', ['as' => 'admin.user.store', 'uses' => 'AuthController@postCreate']);
        Route::get('/{id}/edit', ['as' => 'admin.user.edit', 'uses' => 'AuthController@getEdit']);
        Route::put('/update/{id}', ['as' => 'admin.user.update', 'uses' => 'AuthController@putEdit']);
        Route::get('/delete/{id}', ['as' => 'admin.user.delete', 'uses' => 'AuthController@getDelete']);
        Route::post('/user/massdel', ['as' => 'admin.user.massdel', 'uses' => 'AuthController@massDelete']);
    });
});

Route::group(['prefix' => 'quanly', 'middleware' => 'login', 'namespace' => 'Admin'], function() {

    Route::group(['prefix' => 'post'], function() {
        Route::get('/', ['as' => 'admin.post', 'uses' => 'PostController@index']);
        Route::get('/creat', ['as' => 'admin.post.create', 'uses' => 'PostController@create']);
        Route::post('/store', ['as' => 'admin.post.store', 'uses' => 'PostController@store']);
        Route::get('/{id}/edit', ['as' => 'admin.post.edit', 'uses' => 'PostController@edit']);
        Route::put('/update/{id}', ['as' => 'admin.post.update', 'uses' => 'PostController@update']);
        Route::get('/delete/{id}', ['as' => 'admin.post.delete', 'uses' => 'PostController@destroy']);
        Route::post('/massdel', ['as' => 'admin.post.massdel', 'uses' => 'PostController@massdel']);
        
        Route::get('/order', ['as' => 'post.order', 'uses' => 'PostController@order']);
        Route::get('/search', ['as' => 'post.search', 'uses' => 'PostController@search']);
    });
    
    Route::group(['prefix' => 'page'], function() {
        Route::get('/', ['as' => 'admin.page', 'uses' => 'PageController@index']);
        Route::get('/creat', ['as' => 'admin.page.create', 'uses' => 'PageController@create']);
        Route::post('/store', ['as' => 'admin.page.store', 'uses' => 'PageController@store']);
        Route::get('/{id}/edit', ['as' => 'admin.page.edit', 'uses' => 'PageController@edit']);
        Route::put('/update/{id}', ['as' => 'admin.page.update', 'uses' => 'PageController@update']);
        Route::get('/delete/{id}', ['as' => 'admin.page.delete', 'uses' => 'PageController@destroy']);
        Route::post('/massdel', ['as' => 'admin.page.massdel', 'uses' => 'PageController@massdel']);
        
        Route::get('/order', ['as' => 'page.order', 'uses' => 'PageController@order']);
        Route::get('/search', ['as' => 'page.search', 'uses' => 'PageController@search']);
    });

    Route::group(['prefix' => 'cat'], function() {
        Route::get('/', ['as' => 'admin.cat', 'uses' => 'CategoryController@index']);
        Route::get('/create', ['as' => 'admin.cat.create', 'uses' => 'CategoryController@create']);
        Route::post('/store', ['as' => 'admin.cat.store', 'uses' => 'CategoryController@store']);
        Route::get('/{id}/edit', ['as' => 'admin.cat.edit', 'uses' => 'CategoryController@getEdit']);
        Route::post('/update/{id}', ['as' => 'admin.cat.update', 'uses' => 'CategoryController@update']);
        Route::get('/delete/{id}', ['as' => 'admin.cat.delete', 'uses' => 'CategoryController@getDelete']);
        Route::post('/massdel', ['as' => 'admin.cat.massdel', 'uses' => 'CategoryController@massdel']);
        
        Route::get('/showtree', ['as' => 'admin.cat.showtree', 'uses' => 'CategoryController@showTree']);
    });
    
    Route::group(['prefix' => 'tag'], function(){
        Route::get('/', ['as' => 'admin.tag', 'uses' => 'CategoryController@tagIndex']);
        Route::get('/create', ['as' => 'admin.tag.create', 'uses' => 'CategoryController@tagCreate']);
        Route::post('/store', ['as' => 'admin.tag.store', 'uses' => 'CategoryController@tagStore']);
        Route::get('/{id}/edit', ['as' => 'admin.tag.edit', 'uses' => 'CategoryController@tagEdit']);
        Route::post('/update/{id}', ['as' => 'admin.tag.update', 'uses' => 'CategoryController@tagUpdate']);
        Route::get('/delete/{id}', ['as' => 'admin.tag.delete', 'uses' => 'CategoryController@tagDelete']);
        Route::post('/massdel', ['as' => 'admin.tag.massdel', 'uses' => 'CategoryController@tagMassdel']);
    });
    
    Route::get('/media', ['as' => 'admin.media', 'uses' => 'AdminController@media']);
    
    Route::group(['prefix' => 'medias'], function() {
//        Route::get('/', ['as' => 'admin.media', 'uses' => 'MediaController@index']);
//        Route::get('/create', ['as' => 'admin.media.create', 'uses' => 'MediaController@create']);
//        Route::post('/store', ['as' => 'admin.media.store', 'uses' => 'MediaController@store']);
//        Route::get('/{id}/edit', ['as' => 'admin.media.edit', 'uses' => 'MediaController@edit']);
//        Route::post('/update', ['as' => 'admin.media.update', 'uses' => 'MediaController@update']);
//        Route::get('/delete/{id}', ['as' => 'admin.media.delete', 'uses' => 'MediaController@destroy']);
//        Route::post('/massdel', ['as' => 'admin.media.massdel', 'uses' => 'MediaController@massdel']);
//
//        Route::post('/explorer', ['as' => 'explorer', 'uses' => 'MediaController@explorer']);

        Route::group(['prefix' => 'video'], function() {
            Route::get('/', ['as' => 'admin.video', 'uses' => 'MediaController@videoIndex']);
            Route::get('/create', ['as' => 'admin.video.create', 'uses' => 'MediaController@videoCreate']);
            Route::post('/store', ['as' => 'admin.video.store', 'uses' => 'MediaController@videoStore']);
            Route::get('/{id}/edit', ['as' => 'admin.video.edit', 'uses' => 'MediaController@videoEdit']);
            Route::post('/update', ['as' => 'admin.video.update', 'uses' => 'MediaController@videoUpdate']);
            Route::get('/delete/{id}', ['as' => 'admin.video.delete', 'uses' => 'MediaController@videoDestroy']);
            Route::post('/massdel', ['as' => 'admin.video.massdel', 'uses' => 'MediaController@videoMassdel']);
        });
    });

    Route::group(['prefix' => 'slider'], function() {
        Route::get('/', ['as' => 'slider', 'uses' => 'SliderController@index']);
        Route::get('/create', ['as' => 'slider.create', 'uses' => 'SliderController@create']);
        Route::post('/store', ['as' => 'slider.store', 'uses' => 'SliderController@store']);
        Route::get('/{id}/edit', ['as' => 'slider.edit', 'uses' => 'SliderController@getEdit']);
        Route::put('/update/{id}', ['as' => 'slider.update', 'uses' => 'SliderController@update']);
        Route::get('/delete/{id}', ['as' => 'slider.delete', 'uses' => 'SliderController@getDelete']);
        Route::post('/massdel', ['as' => 'slider.massdel', 'uses' => 'SliderController@massdel']);
        
        Route::get('/{id}/view', ['as' => 'slider.view', 'uses' => 'SliderController@view']);
    });
    
    Route::group(['prefix' => 'slide'], function() {
        Route::get('/create/{group_id}', ['as' => 'slide.create', 'uses' => 'SliderController@itemCreate']);
        Route::post('/store', ['as' => 'slide.store', 'uses' => 'SliderController@itemStore']);
        Route::get('/{id}/edit/{slider_id}', ['as' => 'slide.edit', 'uses' => 'SliderController@itemEdit']);
        Route::put('/update/{id}', ['as' => 'slide.update', 'uses' => 'SliderController@itemUpdate']);
        Route::get('/delete/{id}', ['as' => 'slide.delete', 'uses' => 'SliderController@itemDelete']);
        Route::post('/massdel', ['as' => 'slide.massdel', 'uses' => 'SliderController@itemMassdel']);
    });

    Route::group(['prefix' => 'menuitem'], function() {
        Route::get('/create/{group_id}', ['as' => 'menuitem.create', 'uses' => 'MenuController@itemCreate']);
        Route::post('/store', ['as' => 'menuitem.store', 'uses' => 'MenuController@itemStore']);
        Route::get('/{id}/edit/{group_id}', ['as' => 'menuitem.edit', 'uses' => 'MenuController@itemEdit']);
        Route::put('/update/{id}', ['as' => 'menuitem.update', 'uses' => 'MenuController@itemUpdate']);
        Route::get('/delete/{id}/{group_id}', ['as' => 'menuitem.delete', 'uses' => 'MenuController@itemDelete']);
        Route::post('/massdel', ['as' => 'menuitem.massdel', 'uses' => 'MenuController@itemMassdel']);
    });
    
    Route::group(['prefix' => 'menu'], function() {
        Route::get('/', ['as' => 'admin.menu', 'uses' => 'MenuController@index']);
        Route::get('/create', ['as' => 'admin.menu.create', 'uses' => 'MenuController@create']);
        Route::post('/store', ['as' => 'admin.menu.store', 'uses' => 'MenuController@store']);
        Route::get('/{id}/edit', ['as' => 'admin.menu.edit', 'uses' => 'MenuController@getEdit']);
        Route::post('/update/{id}', ['as' => 'admin.menu.update', 'uses' => 'MenuController@update']);
        Route::get('/delete/{id}', ['as' => 'admin.menu.delete', 'uses' => 'MenuController@getDelete']);
        Route::post('/massdel', ['as' => 'admin.menu.massdel', 'uses' => 'MenuController@massdel']);
    });
    
    Route::get('menu-item/{id}', ['as' => 'menu-item', 'uses' => 'MenuController@itemIndex']);
    Route::group(['prefix' => 'menuitem'], function() {
        Route::get('/create/{group_id}', ['as' => 'menuitem.create', 'uses' => 'MenuController@itemCreate']);
        Route::post('/store', ['as' => 'menuitem.store', 'uses' => 'MenuController@itemStore']);
        Route::get('/{id}/edit/{group_id}', ['as' => 'menuitem.edit', 'uses' => 'MenuController@itemEdit']);
        Route::put('/update/{id}', ['as' => 'menuitem.update', 'uses' => 'MenuController@itemUpdate']);
        Route::get('/delete/{id}/{group_id}', ['as' => 'menuitem.delete', 'uses' => 'MenuController@itemDelete']);
        Route::post('/massdel', ['as' => 'menuitem.massdel', 'uses' => 'MenuController@itemMassdel']);
    });
    
    Route::group(['prefix' => 'setting'], function(){
        Route::get('/', ['as'=>'setting', 'uses' => 'SettingController@index']);
        Route::post('/update', ['as'=>'setting.update', 'uses' => 'SettingController@update']);
    });
    
    Route::group(['prefix' => 'info'], function(){
       Route::get('/', ['as' => 'info', 'uses' => 'SettingController@show_info']); 
    });
    
    Route::group(['prefix' => 'contact'], function(){
       Route::get('/', ['as' => 'contact', 'uses' => 'SettingController@show_contact']); 
    });
});

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController'
]);
