@extends('LBDM::layouts.master')

@section('plugin_css')
    <link rel="stylesheet" href="{{asset('vendor/LBDM/packages/datatabels/datatables.min.css')}}">
@stop

@section('content')
    <!--about us section-->
    <section >
        <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="container">
                                <ul class="nav nav-tabs" id="nav_tabs">
                                    <li id="tab_list" class="active">
                                        <a data-toggle="tab" href="#list">مدیریت</a>
                                    </li>
                                    <li id="tab_new">
                                        <a data-toggle="tab" href="#new">افزودن</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div id="list" class="tab-pane fade in active show">
                                        <table id="basicdata_value_table" class="table table-striped table-bordered">
                                            <thead>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                    <div id="new" class="tab-pane fade">
                                        <div id="insert_basicdata_value_form_id"></div>

                                    </div>
                                    <div id="edit" class="tab-pane fade"></div>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
    </section>
    <!--features section-->

    <!--wrapper end-->
@stop


@section('plugin_js')
    <script src="{{asset('vendor/LBDM/packages/datatabels/datatables.min.js')}}"></script>
    <script src="{{asset('vendor/LBDM/js/jquery-confirm/jquery-confirm.js')}}"></script>
@stop

@section('inline_js')
    @include('LBDM::backend.helper.basicdata_value_inline_js')
  @stop