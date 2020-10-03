<?php

Route::redirect('/', '/login');

Route::redirect('/home', '/admin');

Auth::routes(['register' => false]);

Route::get('change-passwords', 'ChangePasswordController@index')->name('change-passwords');
Route::post('change-password', 'ChangePasswordController@store')->name('change.password');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');

    Route::resource('permissions', 'PermissionsController');

    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');

    Route::resource('roles', 'RolesController');

    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');

    Route::resource('users', 'UsersController');

    Route::delete('products/destroy', 'ProductsController@massDestroy')->name('products.massDestroy');

    Route::resource('gudang', 'GudangController');

    Route::resource('supplier', 'SupplierController');

    Route::resource('customer', 'CustomerController');

    Route::resource('item-category', 'ItemCategoryController');

    Route::resource('item-unit', 'ItemUnitController');

    Route::resource('item', 'ItemController');

    Route::resource('transaksi', 'TransaksiStokController');

    Route::get('transaksi-in','TransaksiStokController@createIn')->name('transaksi-in');
    Route::get('transaksi-out','TransaksiStokController@createOut')->name('transaksi-out');
    Route::post('transaksi-store-out','TransaksiStokController@storeOut')->name('transaksi-store-out');

    Route::get('configuration','ConfigurationController@index')->name('configuration.index');
    Route::get('configuration/create','ConfigurationController@create')->name('configuration.create');
    Route::get('configuration/edit/{id}','ConfigurationController@edit')->name('configuration.edit');
    Route::post('configuration/update/{id}','ConfigurationController@update')->name('configuration.update');
    Route::post('configuration/store','ConfigurationController@store')->name('configuration.store');
});