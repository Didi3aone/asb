<?php

Route::post('login', 'Api\UserApiController@login');
Route::post('register', 'Api\UserApiController@register');
Route::post('daftar', 'Api\UserApiController@daftar'); //reg khusus member

Route::get('job', 'Api\HelperApiController@job');
Route::get('item', 'Api\HelperApiController@item');
Route::get('marital-status', 'Api\HelperApiController@nikah');
Route::get('pob', 'Api\HelperApiController@getPOB');
Route::get('prov', 'Api\HelperApiController@prov');
Route::get('kab', 'Api\HelperApiController@kab');
Route::get('kec', 'Api\HelperApiController@kec');
Route::get('kel', 'Api\HelperApiController@kel');

Route::group(['prefix' => 'v1', 'as' => 'admin.',  'middleware' => ['jwt.verify'], 'namespace' => 'Api\V1\Admin'], function () {
    Route::apiResource('permissions', 'PermissionsApiController');

    Route::apiResource('roles', 'RolesApiController');

    Route::apiResource('users', 'UsersApiController');

    Route::apiResource('products', 'ProductsApiController');
    
    Route::apiResource('program', 'ProgramApiController');
    
    Route::apiResource('artikel', 'InformationApiController');
    Route::get('latest-artikel', 'InformationApiController@indexLatest');
    Route::post('artikel-update', 'InformationApiController@updateArtikel');
    Route::get('search-artikel-by-category', 'InformationApiController@findArticleByCategory');
    Route::apiResource('article-category', 'ArticleCategoryApiController');
    Route::post('update-article-category', 'ArticleCategoryApiController@updateArticle');
    Route::apiResource('member', 'MemberApiController');
    Route::post('member-update', 'MemberApiController@updateMember');
    Route::apiResource('ro', 'RequestOrderApiController');
    Route::get('member-ro', 'RequestOrderApiController@getProgram');
    Route::post('ro-update', 'RequestOrderApiController@updateRO');
    Route::apiResource('slider', 'SliderApiController');
    
});
