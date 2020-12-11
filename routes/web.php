<?php

Route::redirect('/', '/login');

Route::redirect('/home', '/admin');

Auth::routes(['register' => false]);

Route::resource('daftar','RegistrationController');
Route::get('daftar-sukses', 'RegistrationController@successReg')->name('daftar-sukses');
Route::post('post-register', 'RegistrationController@store')->name('post-register');
Route::get('kel', 'RegistrationController@getKelurahan')->name('kel');
Route::get('kec', 'RegistrationController@getKecamatan')->name('kec');
Route::get('kab', 'RegistrationController@getKabupaten')->name('kab');
Route::get('verify', 'RegistrationController@verify')->name('daftar.verify');

Route::get('change-passwords', 'ChangePasswordController@index')->name('change-passwords');
Route::post('change-password', 'ChangePasswordController@store')->name('change.password');

Route::get('img/articles/{filename}', 'ImgController@displayArticles')->name('img.articles');
Route::get('img/thumbnail/{filename}', 'ImgController@displayThumbnail')->name('img.thumbnail');
Route::get('img/avatar/{filename}', 'ImgController@displayAvatar')->name('img.avatar');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::delete('products/destroy', 'ProductsController@massDestroy')->name('products.massDestroy');
    Route::resource('customer', 'CustomerController');

    Route::resource('item-category', 'ItemCategoryController');
    
    Route::resource('item-unit', 'ItemUnitController');

    Route::resource('item', 'ItemController');
    Route::get('create-packet', 'ItemController@createPacket')->name('create-packet');
    Route::post('post-packet', 'ItemController@postPacket')->name('post-packet');
    Route::get('edit-packet', 'ItemController@editPacket')->name('edit-packet');
    Route::get('show-packet/{id}', 'ItemController@showPacket')->name('show-packet');

    //Transaction
    Route::resource('transaksi', 'TransaksiStokController');
    Route::get('transaksi-in','TransaksiStokController@createIn')->name('transaksi-in');
    Route::get('transaksi-out','TransaksiStokController@createOut')->name('transaksi-out');
    Route::post('transaksi-store-out','TransaksiStokController@storeOut')->name('transaksi-store-out');
    Route::get('report-transaksi', 'TransaksiStokController@reportTransaksi')->name('report-transaksi');
    Route::resource('invoice', 'InvoiceController');
    Route::resource('sales-po', 'SalesPOController');
    Route::resource('do', 'DeliveryOrderController');
    

    //RO
    Route::resource('ro', 'RequestOrderController');
    Route::get('report-ro', 'RequestOrderController@reportRO')->name('report-ro');
    
    //PO
    Route::resource('po', 'PurchaseOrderController');
    Route::put('update-payment/{id}', 'PurchaseOrderController@updatePayment')->name('update-payment');
    Route::get('report-po', 'PurchaseOrderController@reportPO')->name('report-po');

    //Information
    Route::resource('info', 'InformationController');
    Route::resource('category', 'ArticleCategoryController');

    //getImage
    Route::get('img/ktp/{filename}', 'ImgController@displayKtp')->name('img.ktp');
    Route::get('img/kk/{filename}', 'ImgController@displayKK')->name('img.kk');
    Route::get('img/avatar/{filename}', 'ImgController@displayAvatar')->name('img.avatar');
    Route::get('img/articles/{filename}', 'ImgController@displayArticles')->name('img.articles');
    Route::get('img/thumbnail/{filename}', 'ImgController@displayThumbnail')->name('img.thumbnail');
    
    

    //Master
    Route::resource('gudang', 'GudangController');
    Route::put('rak-update-partial', 'GudangController@updateRakPartials')->name('rak-update-partial');
    Route::put('rak-add-partial', 'GudangController@addRakPartials')->name('rak-add-partial');
    Route::put('rak-del-partial', 'GudangController@delRakPartials')->name('rak-del-partial');
    Route::resource('supplier', 'SupplierController');
    Route::resource('program', 'ProgramController');
    Route::get('report-program', 'ProgramController@reportProgram')->name('report-program');
    Route::resource('wilayah', 'WilayahController');
    Route::resource('provinsi', 'ProvinsiController');
    Route::get('report-member-prov/{id}', 'ProvinsiController@reportMember')->name('report-member-prov');
    Route::resource('kabupaten', 'KabupatenController');
    Route::get('report-member-kab/{id}', 'KabupatenController@reportMember')->name('report-member-kab');
    Route::resource('kecamatan', 'KecamatanController');
    Route::get('report-member-kec/{id}', 'KecamatanController@reportMember')->name('report-member-kec');
    Route::resource('kelurahan', 'KelurahanController');
    Route::get('report-member-kel/{id}', 'KelurahanController@reportMember')->name('report-member-kel');
    Route::resource('master-member', 'MemberController');
    Route::get('report-member', 'MemberController@reportMember')->name('report-member');
    Route::get('member-verified', 'MemberController@indexVerified')->name('member-verified');
    Route::get('edit-verified', 'MemberController@editVerified')->name('edit-verified');
    Route::put('update-verified', 'MemberController@editVerified')->name('update-verified');
    Route::get('edit-korlap/{id}', 'MemberController@editKorlap')->name('edit-korlap');
    Route::put('update-korlap/{id}', 'MemberController@updateKorlap')->name('update-korlap');
    Route::get('member-pending', 'MemberController@indexPending')->name('member-pending');

    //Settings
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');
    Route::get('configuration','ConfigurationController@index')->name('configuration.index');
    Route::get('configuration/create','ConfigurationController@create')->name('configuration.create');
    Route::get('configuration/edit/{id}','ConfigurationController@edit')->name('configuration.edit');
    Route::put('configuration/update/{id}','ConfigurationController@update')->name('configuration.update');
    Route::post('configuration/store','ConfigurationController@store')->name('configuration.store');
    Route::resource('template', 'ThemeController');
    Route::get('change-template', 'ThemeController@change')->name('change-template');
    Route::post('change-template', 'ThemeController@changePost')->name('change-template');

    //helper
    Route::get('get-kel', 'HelperController@getKelurahan')->name('get-kel');
    Route::get('get-kec', 'HelperController@getKecamatan')->name('get-kec');
    Route::get('get-kab', 'HelperController@getKabupaten')->name('get-kab');
    Route::get('get-member', 'HelperController@getMember')->name('get-member');
    Route::get('get-rak', 'HelperController@getRak')->name('get-rak');
    Route::get('get-product', 'HelperController@getProduct')->name('get-product');
    
});
