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

Route::get('/', 'Rong\IndexController@user');
//登录组路由
Route::group(['prefix'=>'rongjie','namespace'=>'Admin'],function(){
    Route::get('login','LoginController@login');//登录界面路由
    Route::get('logout','LoginController@logout');//退出路由
    Route::get('verify','CommController@Verify');//验证码路由
    Route::post('dologin','LoginController@doLogin');//执行登录方法路由
});
//后台组路由
Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>['check.login']],function(){
    Route::get('index','IndexController@index');//后台首页
//    Route::get('remove','UserController@remove');//多条删除
    Route::get('ajaxPage','AlbumController@ajaxPage');//分页
    Route::get('ajaxNewsPage','NewsController@ajaxPage');//动态 分页

    Route::get('times','IndexController@logintimes');//登录次数查询
    Route::match(['get','post'],'user','IndexController@updateuserinfo');//用户操作界面
    Route::match(['get','post'],'pass','IndexController@updatepwd');//用户密码
    Route::post('upload','IndexController@imagesUpload');//头像上传
    Route::resource('album','AlbumController');//相册资源路由
    Route::resource('category','CategoryController');//栏目资源路由
    Route::resource('active','NewsController');//动态资源路由

});

//前台组路由
Route::group(['prefix'=>'home','namespace'=>'Rong'],function(){
    Route::get('index/{cid?}','IndexController@index');//照片列表
    Route::get('content/{pid?}','IndexController@imageContent');//照片内容


});

