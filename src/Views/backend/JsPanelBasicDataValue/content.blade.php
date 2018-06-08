<div class="container">
    <ul class="nav nav-tabs" id="nav_tabs_value">
        <li id="tab_list_basicdata_value" class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#list_basicdata_value">مدیریت</a>
        </li>
        <li id="tab_new_basicdata_value">
            <a class="nav-link" data-toggle="tab" href="#new_basicdata_value">افزودن</a>
        </li>
    </ul>
    <div class="tab-content font-12 text-right" style="padding-top: 10px;">
        <div id="list_basicdata_value" class="tab-pane fade in active show">
            <table id="basicdata_value_table" class="table table-striped table-bordered">
                <thead>
                <tr>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <div id="new_basicdata_value" class="tab-pane fade">
            <div class="space-10"></div>
            <div id="message_basic_data_value_insert" class="form_message_area"></div>
            <form id="FormInsertBasicDataValue" class="form-horizontal">

                {{-- <div class="form-group col-xs-12">
                    <label class="col-sm-3 text-center"><span
                                class="red-star">*</span><span>والد:</span></label>
                    <div class="col-sm-5">
                        <select class="form-control" name="basicdata_id" id="select_basicdata">
                          @if(isset($basicdata) && $basicdata)
                                @foreach($basicdata as $basic)
                                    <option value="{{$basic->id}}" @if($basicdata_selected->id==$basic->id) selected @endif>{{$basic->title}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-sm-4" id="#error_title"></div>
                </div>--}}
                <div class="form-group col-xs-12 fg_title">
                    <label class="col-sm-3 text-center control-label label_title" for="title">
                        <span class="more_info"></span>
                        <span class="red-star">*</span>
                        <span>عنوان:</span>
                    </label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="title"/>
                    </div>
                    <div class="col-sm-4 messages"></div>
                </div>
                {{--
                <div class="form-group col-xs-12">
                    <label class="col-sm-3 text-center"><span
                                class="red-star">*</span><span>عنوان مورد استفاده:</span>
                    </label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="dev_title"/>
                    </div>
                    <div class="col-sm-4" id="#error_dev_title"></div>
                </div>
                <div class="form-group col-xs-12">
                    <label class="col-sm-3 text-center">
                        <span class="red-star"></span>
                        <span>مقدار ثابت:</span>
                    </label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="dev_val"/>
                    </div>
                    <div class="col-sm-4" id="#error_dev_val"></div>
                </div>
                <div class="form-group col-xs-12">
                    <label class="col-sm-3 text-center"><span class="red-star"></span><span>توضیحات:</span></label>
                    <div class="col-sm-5">
                      <textarea type="text" class="form-control" name="comment"></textarea>
                    </div>
                    <div class="col-sm-4" id="#error_comment"></div>
                </div>
                <div class="form-group col-xs-12">
                    <label class="col-sm-3 text-center">
                        <span class="red-star"></span>
                        <span>داده های بیشتر:</span></label>
                    <div class="col-sm-5">
                        <input  type="text" class="form-control" name="extra_field" id="extra_field"/>
                    </div>
                    <div class="col-sm-4" id="#error_title"></div>
                </div>
                <div class="form-group  col-xs-12">
                    <label class="col-sm-3 text-center">
                        <span class="red-star">*</span><span>وضعیت:</span>
                    </label>
                    <div class="col-sm-5 text-right">
                        <input type="radio" name="is_active" value="1" checked/>
                        <span> فعال </span>
                        <input type="radio" name="is_active" value="0"/>
                        <span> غیرفعال </span>
                    </div>
                    <div class="col-sm-4" id="#error_msg_is_active"></div>
                </div>
                <div class="form-group col-xs-12">
                    <label class="col-sm-3"></label>
                    <div class="col-sm-5 text-right">
                        <input type="hidden" class="btn btn-success" id="submit_insert_basicdata_value" value="ثبت"/>
                        <div class="messsage"></div>
                    </div>
                    <div class="col-sm-4"></div>
                </div>
                --}}
                <div class="form-group fg_submit col-xs-12">
                    <div class="col-sm-5 col-sm-offset-3">
                        <button type="submit" name="submit" id="submit_insert_basicdata_value" class="btn btn-success">ثبت وتایید</button>
                    </div>
                </div>
            </form>
        </div>
        <div id="edit_basicdata_value" class="tab-pane fade"></div>
    </div>
</div>
@include('LBDM::backend.helper.basicdata_value_inline_js')