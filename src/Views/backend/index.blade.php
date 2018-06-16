@extends('LBDM::layouts.master')

@section('plugin_css')
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/laravel_basicdata_manager/packages/jstree/themes/default/style.min.css')}}">
@stop

@section('plugin_js')
    <script type="text/javascript" src="{{asset('vendor/laravel_basicdata_manager/packages/jstree/jstree.min.js')}}"></script>
@stop

@section('content')
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class=" col-lg-3">
                    <div id="jstree_basic"></div>
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-12">
                            <div class="container">
                                <ul class="nav nav-tabs" id="nav_tabs">
                                    <li id="tab_list" class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#list">مدیریت</a>
                                    </li>
                                    <li class="nav-item" id="tab_new">
                                        <a class="nav-link" data-toggle="tab" href="#new">افزودن</a>
                                    </li>
                                </ul>
                                <div class="tab-content font-12">
                                    <div id="list" class="tab-pane active show">
                                        <div class="text-left">
                                            <span class="fas fa-filter" id="basic_data_filter_icon" style="font-size: 25px;color: #525252;margin-top: 20px;cursor: pointer;"></span>
                                        </div>
                                        <div id="div_base_filter_basicdata" class="container">
                                            <form id="FormFilter">
                                                <div class="form-group col-12 row">
                                                    <label class="col-sm-1 text-center">
                                                        <span class="red-star"></span><span>والد:</span>
                                                    </label>
                                                    <div class="col-sm-5 text-right">
                                                        <select class="form-control" name="filter_id" id="select_parent"></select>
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <button type="button" id="btn_filter_basicdata" class="btn btn-success btn-md">اعمال</button>
                                                        <button type="button" id="btn_filter_basicdata_cancel" class="btn btn-default btn-md">لغو فیلتر</button>
                                                    </div>
                                                </div>
                                                <div class="hr"></div>
                                            </form>
                                        </div>
                                        <div class="container">
                                            <table id="basicdata_table" class="table table-striped table-bordered text-right"></table>
                                        </div>
                                    </div>
                                    <div id="new" class="tab-pane">
                                        <div id="insert_basicdata_form_id" class="form_message_area"></div>
                                        <div class="space-10"></div>
                                        <form id="FormInsertBasicData" class="form-horizontal inner_tab col-12 relative">

                                            <div class="form-group col-12 fg_parent_id row">
                                                <label class="col-sm-3 text-center control-label label_parent_id" for="parent_id">
                                                    <span class="more_info"></span>
                                                    <span class="red-star">*</span>
                                                    <span>والد:</span>
                                                </label>
                                                <div class="col-sm-5">
                                                    <select class="form-control" name="parent_id" id="parent_id">
                                                    </select>
                                                </div>
                                                <div class="col-sm-4 messages"></div>
                                            </div>
                                            <div class="form-group col-12 fg_title row">
                                                <label class="col-sm-3 text-center control-label label_title" for="title">
                                                    <span class="more_info"></span>
                                                    <span class="red-star">*</span>
                                                    <span>عنوان:</span>
                                                </label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" name="title" id="title"/>
                                                </div>
                                                <div class="col-sm-4 messages"></div>
                                            </div>
                                            {{--<div class="form-group col-12 fg_dev_title row">
                                                <label class="col-sm-3 text-center control-label label_dev_title" for="dev_title">
                                                    <span class="more_info"></span>
                                                    <span class="red-star">*</span>
                                                    <span>عنوان مورد استفاده:</span>
                                                </label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" name="dev_title"/>
                                                </div>
                                                <div class="col-sm-4 messages"></div>
                                            </div>
                                            <div class="form-group col-12 fg_comment row">
                                                <label class="col-sm-3 text-center control-label label_comment" for="comment">
                                                    <span class="more_info"></span>
                                                    <span class="red-star"></span>
                                                    <span>توضیحات:</span>
                                                </label>
                                                <div class="col-sm-5">
                                                    <textarea type="text" class="form-control" name="comment"></textarea>
                                                </div>
                                                <div class="col-sm-4 messages"></div>
                                            </div>
                                            <div class="form-group col-12 fg_dev_comment row">
                                                <label class="col-sm-3 text-center control-label label_dev_comment" for="dev_comment">
                                                    <span class="more_info"></span>
                                                    <span class="red-star"></span>
                                                    <span>توضیحات مورد استفاده:</span>
                                                </label>
                                                <div class="col-sm-5">
                                                    <textarea type="text" class="form-control" name="dev_comment"></textarea>
                                                </div>
                                                <div class="col-sm-4 messages"></div>
                                            </div>
                                            <div class="form-group col-12 fg_extra_field row">
                                                <label class="col-sm-3 text-center control-label label_extra_field" for="extra_field">
                                                    <span class="more_info"></span>
                                                    <span class="red-star"></span>
                                                    <span>داده های بیشتر:</span>
                                                </label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" name="extra_field" id="extra_field"/>
                                                </div>
                                                <div class="col-sm-4 messages"></div>
                                            </div>
                                            <div class="form-group col-12 fg_is_active row">
                                                <label class="col-sm-3 text-center control-label label_is_active" for="is_active">
                                                    <span class="more_info"></span>
                                                    <span class="red-star">*</span>
                                                    <span>وضعیت:</span>
                                                </label>
                                                <div class="col-sm-5 text-right">
                                                    <input type="radio" name="is_active" value="1" checked/>
                                                    <span> فعال </span>
                                                    <input type="radio" name="is_active" value="0"/>
                                                    <span> غیرفعال </span>
                                                </div>
                                                <div class="col-sm-4 messages"></div>
                                            </div>--}}
                                            <div class="form-group col-12 fg_submit row">
                                                <div class="col-sm-5 offset-sm-3">
                                                    <button type="submit" name="submit" class="btn btn-success">ثبت</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div id="edit" class="tab-pane"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@section('footer_inline_js')
    @include('LBDM::backend.helper.basicdata_inline_js')
@stop