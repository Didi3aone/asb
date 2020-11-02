<?php

Route::group(['prefix' => 'v1', 'as' => 'admin.', 'namespace' => 'Api\V1\Admin'], function () {
    Route::apiResource('permissions', 'PermissionsApiController');

    Route::apiResource('roles', 'RolesApiController');

    Route::apiResource('users', 'UsersApiController');

    Route::apiResource('products', 'ProductsApiController');
    
    Route::apiResource('program', 'ProgramApiController');
    
    Route::apiResource('artikel', 'InformationApiController');
    Route::apiResource('member', 'MemberApiController');

    Route::get('job', 'HelperApiController@job');
    Route::get('marital-status', 'HelperApiController@nikah');
    Route::get('prov', 'HelperApiController@prov');
    Route::get('kab', 'HelperApiController@kab');
    Route::get('kec', 'HelperApiController@kec');
    Route::get('kel', 'HelperApiController@kel');
    
});
