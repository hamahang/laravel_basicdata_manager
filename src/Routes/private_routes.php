<?php
Route::group(['prefix' => config('laravel_basicdata_manager.private_route_prefix'), 'namespace' => 'ArtinCMS\LBDM\Controllers', 'middleware' => config('laravel_basicdata_manager.private_middlewares')], function () {
    Route::get('index', ['as' => 'LBDM.Index', 'uses' => 'LBDMController@index']);
/*    Route::get('index_basicdata_value', ['as' => 'LBDM.IndexBasicDataValue', 'uses' => 'LBDMController@index_basicdata_value']);*/

    Route::post('get_articles', ['as' => 'LBDM.GridMyFiles', 'uses' => 'LBDMController@get_articles']);
    Route::post('get_basicdata', ['as' => 'LBDM.GetBasicData', 'uses' => 'LBDMController@list_basicdata']);
    Route::post('get_basicdata_value', ['as' => 'LBDM.GetBasicDataValue', 'uses' => 'LBDMController@list_basicdata_value']);

    Route::post('delete_basicdata', ['as' => 'LBDM.DeleteBasicData', 'uses' => 'LBDMController@delete_basicdata']);
    Route::post('delete_basicdata_value', ['as' => 'LBDM.DeleteBasicDataValue', 'uses' => 'LBDMController@delete_basicdata_value']);

    Route::post('insert_basicdata', ['as' => 'LBDM.InsertBasicData', 'uses' => 'LBDMController@insert_basicdata']);
    Route::post('update_basicdata', ['as' => 'LBDM.UpdateBasicData', 'uses' => 'LBDMController@update_basicdata']);

    Route::post('insert_basicdata_value', ['as' => 'LBDM.InsertBasicDataValue', 'uses' => 'LBDMController@insert_basicdata_value']);
    Route::post('update_basicdata_value', ['as' => 'LBDM.UpdateBasicDataValue', 'uses' => 'LBDMController@update_basicdata_value']);

    Route::post('js_basicdata_value',['as'=>'LBDM.JSBasicDataValue','uses'=>'LBDMController@JSBasicDataValue']);
    Route::post('show_edit_basicdata',['as'=>'LBDM.ShowEditBasicdata','uses'=>'LBDMController@show_edit_basicdata']);
    Route::post('show_edit_basicdata_value',['as'=>'LBDM.ShowEditBasicdatValue','uses'=>'LBDMController@show_edit_basicdata_value']);

    Route::post('basic_select2',['as'=>'LBDM.AutoCompleteBasicdat','uses'=>'LBDMController@basic_select2']);
    Route::post('save_order_basicdata',['as'=>'LBDM.SaveOrderBasicdata','uses'=>'LBDMController@save_order_basicdata']);
    Route::post('get_jstree_basicdata',['as'=>'LBDM.GetJsTreeBasicdata','uses'=>'LBDMController@get_jstree_basicdata']);


    Route::post('save_order_basicdata_value',['as'=>'LBDM.SaveOrderBasicdataValue','uses'=>'LBDMController@save_order_basicdata_value']);
});

