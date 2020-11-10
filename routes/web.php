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
    Route::resource('ro', 'RequestOrderController');
    Route::get('report-ro', 'RequestOrderController@reportRO')->name('report-ro');
    Route::resource('po', 'PurchaseOrderController');
    Route::get('report-po', 'PurchaseOrderController@reportPO')->name('report-po');

    //Information
    Route::resource('info', 'InformationController');
    Route::resource('category', 'ArticleCategoryController');

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
    Route::resource('kabupaten', 'KabupatenController');
    Route::resource('kecamatan', 'KecamatanController');
    Route::resource('kelurahan', 'KelurahanController');
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

    //helper
    Route::get('get-kel', 'HelperController@getKelurahan')->name('get-kel');
    Route::get('get-kec', 'HelperController@getKecamatan')->name('get-kec');
    Route::get('get-kab', 'HelperController@getKabupaten')->name('get-kab');
    Route::get('get-member', 'HelperController@getMember')->name('get-member');
    
});
