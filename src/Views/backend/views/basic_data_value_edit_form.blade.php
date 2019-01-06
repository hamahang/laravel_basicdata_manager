<div class="tab-pane" id="edit_basic_data_value_tab">
    <form id="frm_edit_basic_data_value" class="form-horizontal" name="frm_edit_basic_data_value">
        <input type="hidden" name="item_id" value="{{ LBDM_EnCodeId($basic_data_value->id) }}">
        <div class="form-group fg_company_type">
            <label class="col-sm-3 control-label label_post" for="basic_data_value_parent_id">
                <span class="more_info"></span>
                {{--<span class="red_star">*</span>--}}
                <span class="label_title">گروه (داده اولیه)</span>
            </label>
            <div class="col-sm-5">
                <select name="basicdata_id" class="form-control" id="basic_data_value_edit_parent_id" tab="1" disabled>
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
                <input name="title" class="form-control" id="basic_data_value_edit_title" value="{{ $basic_data_value->title }}" tab="2">
            </div>
            <div class="col-sm-4 messages"></div>
        </div>
        <div class="form-group fg_company_type">
            <label class="col-sm-3 control-label label_post" for="value">
                <span class="more_info"></span>
                <span class="label_title">مقدار</span>
            </label>
            <div class="col-sm-5">

                <input name="value" class="form-control" value="{{ $basic_data_value->value }}" id="edit_basic_data_value_value" tab="3">
                <textarea disabled="disabled" class="form-control" rows="3" disabled="disabled" name="value" id="edit_basic_data_value_textarea" tab="3">{{ $basic_data_value->value }}</textarea>
                <div class="space-10"></div>
                <button class="showSummernotes btn btn-success" type="button" data-value="0">نمایش ویرایشگر</button>
                <button class="hideSummernotes btn btn-success" type="button" data-value="1">پنهان کردن ویرایشگر</button>
            </div>
            <div class="col-sm-4 messages"></div>
        </div>
        <div class="form-group fg_company_type">
            <label class="col-sm-3 control-label label_post" for="comment">
                <span class="more_info"></span>
                <span class="label_title">توضیحات</span>
            </label>
            <div class="col-sm-5">
                <input name="comment" class="form-control" id="basic_data_value_edit_comment" value="{{ $basic_data_value->comment }}" tab="3">
            </div>
            <div class="col-sm-4 messages"></div>
        </div>
        <div class="clearfixed"></div>
        <div class="row text-left">
            <button type="button" class="btn btn-labeled cancel_edit_basic_data_value"><b><i class="fa fa-times"></i></b>لغو</button>
            <button type="submit" class="btn bg-teal-400 btn-labeled"><b><i class="fa fa-save"></i></b>ویرایش</button>
        </div>
    </form>
</div>

<script>
    init_select2_data('#basic_data_value_edit_parent_id', {!! LBDM_Get_BasicData_json() !!}, false, false, false, false, 'داده اولیه...');
    $('#basic_data_value_edit_parent_id').val({{ $basic_data_value->basicdata_id }}).trigger('change');
</script>