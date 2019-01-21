<?php
Route::group(['prefix' => config('laravel_basicdata_manager.private_route_prefix'), 'namespace' => 'ArtinCMS\LBDM\Controllers', 'middleware' => config('laravel_basicdata_manager.private_middlewares')], function () {
    Route::get('/', ['as' => 'LBDM.index', 'uses' => 'LBDMController@index']);
    Route::post('get_basic_data', ['as' => 'LBDM.get_basic_data', 'uses' => 'LBDMController@getBasicdata']);
    Route::post('get_basic_data_value', ['as' => 'LBDM.get_basic_data_value', 'uses' => 'LBDMController@getBasicdataValue']);
    Route::post('create_basic_data', ['as' => 'LBDM.create_basic_data', 'uses' => 'LBDMController@createBasicdata']);
    Route::post('create_basic_data_value', ['as' => 'LBDM.create_basic_data_value', 'uses' => 'LBDMController@createBasicdataValue']);
    Route::post('get_basic_data_edit_form', ['as' => 'LBDM.get_basic_data_edit_form', 'uses' => 'LBDMController@getBasicdataEditForm']);
    Route::post('get_basic_data_value_edit_form', ['as' => 'LBDM.get_basic_data_value_edit_form', 'uses' => 'LBDMController@getBasicdataValueEditForm']);
    Route::post('edit_basic_data', ['as' => 'LBDM.edit_basic_data', 'uses' => 'LBDMController@editBasicdata']);
    Route::post('delete_basic_data', ['as' => 'LBDM.delete_basic_data', 'uses' => 'LBDMController@deleteBasicdata']);
    Route::post('delete_basic_data_value', ['as' => 'LBDM.delete_basic_data_value', 'uses' => 'LBDMController@deleteBasicdataValue']);
    Route::post('edit_basic_data_value', ['as' => 'LBDM.edit_basic_data_value', 'uses' => 'LBDMController@editBasicdataValue']);
    Route::post('save_order_basicdata_value_item', ['as' => 'LBDM.save_order_basicdata_value_item', 'uses' => 'LBDMController@saveOrderBasicdataValueItem']);
    Route::post('save_order_basicdata_item', ['as' => 'LBDM.save_order_basicdata_item', 'uses' => 'LBDMController@saveOrderBasicdataItem']);
});

