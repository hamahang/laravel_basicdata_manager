@extends('LBDM::layouts.master')

@section('content')
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class=" col-lg-3">
                    <div id="jstree_basic"></div>
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-xs-12">
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
                                            <span class="fas fa-filter" id="basic_data_filter_icon"
                                                  style="font-size: 25px;color: #525252;margin-top: 20px;cursor: pointer;"></span>
                                        </div>
                                        <div id="div_base_filter_basicdata" class="col-xs-12">
                                            <form id="FormFilter">
                                                <div class="form-group  col-xs-12">
                                                    <lable class="col-sm-1 text-center">
                                                        <span class="red-star"></span><span>والد:</span>
                                                    </lable>
                                                    <div class="col-sm-5 text-right">
                                                        <select class="form-control" name="filter_id"
                                                                id="select_parent"></select>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <button type="button" id="btn_filter"
                                                                class="btn btn-success btn-md">اعمال
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-xs-12">
                                            <table id="basicdata_table"
                                                   class="table table-striped  table-bordered text-right"></table>
                                        </div>
                                    </div>
                                    <div id="new" class="tab-pane">
                                        <div id="insert_basicdata_form_id"></div>
                                        <form id="FormInsertBasicData">
                                            <div class="space-10"></div>
                                            <div class="form-group col-xs-12">
                                                <lable class="col-sm-3 text-center">
                                                    <span class="red-star">*</span>
                                                    <span>والد:</span></lable>
                                                <div class="col-sm-5">
                                                    <select class="form-control" name="parent_id" id="parent_id">
                                                    </select>
                                                </div>
                                                <div class="col-sm-4" id="#error_title"></div>
                                            </div>
                                            <div class="form-group col-xs-12">
                                                <lable class="col-sm-3 text-center">
                                                    <span class="red-star">*</span>
                                                    <span>عنوان:</span></lable>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" name="title"/>
                                                </div>
                                                <div class="col-sm-4" id="#error_title"></div>
                                            </div>
                                            <div class="form-group col-xs-12">
                                                <lable class="col-sm-3 text-center"><span
                                                            class="red-star">*</span><span>عنوان مورد استفاده:</span>
                                                </lable>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" name="dev_title"/>
                                                </div>
                                                <div class="col-sm-4" id="#error_dev_title"></div>
                                            </div>
                                            <div class="form-group col-xs-12">
                                                <lable class="col-sm-3 text-center"><span class="red-star"></span><span>توضیحات:</span>
                                                </lable>
                                                <div class="col-sm-5">
                                                    <textarea type="text" class="form-control"
                                                              name="comment"></textarea>
                                                </div>
                                                <div class="col-sm-4" id="#error_comment"></div>
                                            </div>
                                            <div class="form-group col-xs-12">
                                                <lable class="col-sm-3 text-center">
                                                    <span class="red-star"></span>
                                                    <span>داده های بیشتر:</span></lable>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" name="extra_field" id="extra_field"/>
                                                </div>
                                                <div class="col-sm-4" id="#error_title"></div>
                                            </div>
                                            <div class="form-group  col-xs-12">
                                                <lable class="col-sm-3 text-center">
                                                    <span class="red-star">*</span><span>وضعیت:</span>
                                                </lable>
                                                <div class="col-sm-5 text-right">
                                                    <input type="radio" name="is_active" value="1" checked/>
                                                    <span> فعال </span>
                                                    <input type="radio" name="is_active" value="0"/>
                                                    <span> غیرفعال </span>
                                                </div>
                                                <div class="col-sm-4" id="#error_msg_is_active"></div>
                                            </div>
                                            <div class="form-group col-xs-12">
                                                <lable class="col-sm-3"></lable>
                                                <div class="col-sm-5 text-right">
                                                    <input type="button" class="btn btn-success"
                                                           id="submit_insert_basicdata" value="ثبت"/>
                                                </div>
                                                <div class="col-sm-4"></div>
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

@section('inline_js')
    @include('LBDM::backend.helper.basicdata_inline_js')
@stop