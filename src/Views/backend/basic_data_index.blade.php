@extends('laravel_basicdata_manager::layouts.master')
@section('page_title')
    مدیریت مقادیر اولیه
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat">
                <div class="panel-body">
                    <div class="tabbable">
                        <ul class="nav nav-tabs nav-tabs-bottom" id="manage_basic_data">
                            <li id="tab_manage_basic_data_tab" class="active"><a href="#manage_tab_basic_data" data-toggle="tab" id="tab_link_manage_basic_data_tab">مدیریت</a></li>
                            <li id="tab_add_tab"><a href="#add_basic_data_tab" data-toggle="tab">افزودن</a></li>
                            <li id="div_edit_basic_data" class="hide">
                                <button class="close closeTab cancel_edit_basic_data" type="button">×</button>
                                <span class="divider">|</span>
                                <a href="#edit_basic_data_tab" style="margin-left: 10px" data-toggle="tab" class="edit_basic_data" id="">ویرایش</a>
                            </li>
                            <li class="manage_value_tab_div hide">
                                <button class="close closeTab btn_close_values_list_tab" type="button">×</button>
                                <span class="divider">|</span><a href="#manage_basic_data_value_tab" style="margin-left: 10px;" class="manage_basic_data_value_title" data-toggle="tab"></a>
                            </li>
                        </ul>
                        <div class="tab-content" id="basic_data_tab_content">
                            <div class="tab-pane active" id="manage_tab_basic_data">
                                <div class="active pull-right btn_filter_datatables" style="cursor: pointer;"><i class="fas fa-filter"></i></div>
                                <div class="forms_datatable_filters" style="display: none; ">
                                    <form class="form-horizontal">
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label label_post" for="value">
                                                    <span class="more_info"></span>
                                                    <span class="label_title">فیلتر مقادیر اولیه</span>
                                                </label>
                                                <div class="col-sm-7">
                                                    <select id="filter_process" class="form-control select" name="parent">
                                                        <option value="-1">نمایش همه</option>
                                                        @foreach($basicData as $data)
                                                            <option value="{{ $data->id }}">{{ $data->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-4 messages"></div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="clearfix"></div>
                                    <hr/>
                                </div>
                                <div id="basic_data_grid_data_div_parent">
                                    <div class="col-xs-12 basic_data_grid_data_div">
                                        <table id="basicDataGridData" class="table" width="100%"></table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="add_basic_data_tab">
                                <form id="frm_add_new_basic_data" class="form-horizontal" name="frm_add_new_basic_data">
                                    <div class="form-group fg_company_type">
                                        <label class="col-sm-3 control-label label_post" for="parent_id">
                                            <span class="more_info"></span>
                                            {{--<span class="red_star">*</span>--}}
                                            <span class="label_title">والد</span>
                                        </label>
                                        <div class="col-sm-5">
                                            <select name="parent_id" class="form-control" id="parent_id" tab="1">
                                                <option></option>
                                            </select>
                                        </div>
                                        <div class="col-sm-4 messages"></div>
                                    </div>
                                    <div class="form-group fg_company_type">
                                        <label class="col-sm-3 control-label label_post" for="title">
                                            <span class="more_info"></span>
                                            <span class="label_title">عنوان</span>
                                        </label>
                                        <div class="col-sm-5">
                                            <input name="title" class="form-control" id="title" tab="2" autocomplete="off">
                                        </div>
                                        <div class="col-sm-4 messages"></div>
                                    </div>
                                    <div class="form-group fg_company_type">
                                        <label class="col-sm-3 control-label label_post" for="comment">
                                            <span class="more_info"></span>
                                            <span class="label_title">توضیحات</span>
                                        </label>
                                        <div class="col-sm-5">
                                            <input name="comment" class="form-control" id="comment" tab="3" autocomplete="off">
                                        </div>
                                        <div class="col-sm-4 messages"></div>
                                    </div>
                                    <div class="clearfixed"></div>
                                    <div class="row text-left">
                                        <button type="button" class="btn btn-labeled cancel_create_basic_data"><b><i class="fa fa-times"></i></b>لغو</button>
                                        <button type="submit" class="btn bg-teal-400 btn-labeled"><b><i class="fa fa-save"></i></b>ذخیره</button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane active" id="edit_basic_data_tab"></div>
                            <div class="tab-pane basic_data_value_tab_div" id="manage_basic_data_value_tab">
                                <div class="col-xs-12">
                                    <div class="tabbable">
                                        <ul class="nav nav-tabs nav-tabs-bottom">
                                            <li class="active"><a href="#basic_data_value_list_div" data-toggle="tab">مدیریت</a></li>
                                            <li><a href="#add_basic_data_value_tab" data-toggle="tab">افزودن</a></li>
                                            <li class="hide" id="tab_edit_basic_data_value">
                                                <button class="close closeTab cancel_edit_basic_data_value" type="button">×</button>
                                                <span class="divider">|</span>
                                                <a href="#edit_basic_data_value_tab" style="margin-left: 10px;" data-toggle="tab" class="edit_basic_data_value">ویرایش</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active basic_data_values_list" id="basic_data_value_list_div"></div>
                                            <div class="tab-pane" id="add_basic_data_value_tab">
                                                <div class="tab-pane" id="create_basic_data_value_tab">
                                                    <form id="frm_create_basic_data_value" class="form-horizontal" name="frm_create_basic_data_value">
                                                        <input type="hidden" value="" name="basicdata_id_hidden" id="basicdata_id_hidden">
                                                        <div class="form-group fg_company_type">
                                                            <label class="col-sm-3 control-label label_post" for="parent_id">
                                                                <span class="more_info"></span>
                                                                {{--<span class="red_star">*</span>--}}
                                                                <span class="label_title">گروه (داده اولیه)</span>
                                                            </label>
                                                            <div class="col-sm-5">
                                                                <select name="basicdata_id" class="form-control" id="basic_data_value_parent_id" tab="1" disabled>
                                                                    <option></option>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-4 messages"></div>
                                                        </div>
                                                        <div class="form-group fg_company_type">
                                                            <label class="col-sm-3 control-label label_post" for="title">
                                                                <span class="more_info"></span>
                                                                <span class="label_title">عنوان</span>
                                                            </label>
                                                            <div class="col-sm-5">
                                                                <input name="title" class="form-control" id="basic_data_value_title" tab="2" autocomplete="off">
                                                            </div>
                                                            <div class="col-sm-4 messages"></div>
                                                        </div>
                                                        <div class="form-group fg_company_type">
                                                            <label class="col-sm-3 control-label label_post" for="value">
                                                                <span class="more_info"></span>
                                                                <span class="label_title">مقدار</span>
                                                            </label>
                                                            <div class="col-sm-5">
                                                                <input name="value" class="form-control" id="basic_data_value_value" tab="3" autocomplete="off">
                                                                <textarea disabled="disabled" class="form-control" rows="3" name="value" id="basic_data_value_textarea" tab="3"></textarea>
                                                                <div class="space-10"></div>
                                                                <button class="show_summernotes btn btn-success" type="button" data-value="0">نمایش ویرایشگر</button>
                                                                <button class="hide_summernotes btn btn-success" type="button" data-value="1">پنهان کردن ویرایشگر</button>
                                                            </div>
                                                            <div class="col-sm-4 messages"></div>
                                                        </div>
                                                        <div class="form-group fg_company_type">
                                                            <label class="col-sm-3 control-label label_post" for="comment">
                                                                <span class="more_info"></span>
                                                                <span class="label_title">توضیحات</span>
                                                            </label>
                                                            <div class="col-sm-5">
                                                                <input name="comment" class="form-control" id="basic_data_value_comment" tab="4" autocomplete="off">
                                                            </div>
                                                            <div class="col-sm-4 messages"></div>
                                                        </div>
                                                        <div class="clearfixed"></div>
                                                        <div class="row text-left">
                                                            <button type="button" class="btn btn-labeled cancel_create_basic_data_value"><b><i class="fa fa-times"></i></b>لغو</button>
                                                            <button type="submit" class="btn bg-teal-400 btn-labeled"><b><i class="fa fa-save"></i></b>ذخیره</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="edit_basic_data_value_tab"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane active" id="manage_value_tab"></div>
                            <div class="tab-pane active" id="edit_basic_data_value_tab"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('inline_js')
    @include('laravel_basicdata_manager::backend.helper.basic_data_inline_js')
@stop