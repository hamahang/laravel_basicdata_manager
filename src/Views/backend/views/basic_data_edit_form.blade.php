<div class="tab-pane" id="edit_basic_data_tab">
    <form id="frm_edit_basic_data" class="form-horizontal" name="frm_edit_basic_data">
        <input type="hidden" name="item_id" value="{{ LBDM_EnCodeId($basic_data->id) }}">
        <div class="form-group fg_company_type">
            <label class="col-sm-3 control-label label_post" for="parent_id">
                <span class="more_info"></span>
                {{--<span class="red_star">*</span>--}}
                <span class="label_title">والد</span>
            </label>
            <div class="col-sm-5">
                <select name="parent_id" class="form-control" id="edit_parent_id" tab="1">
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
                <input name="title" class="form-control" id="edit_title" value="{{ $basic_data->title }}" autocomplete="off" tab="2">
            </div>
            <div class="col-sm-4 messages"></div>
        </div>
        <div class="form-group fg_company_type">
            <label class="col-sm-3 control-label label_post" for="comment">
                <span class="more_info"></span>
                <span class="label_title">توضیحات</span>
            </label>
            <div class="col-sm-6">
                <input name="comment" class="form-control" id="edit_comment" value="{{ $basic_data->comment }}" tab="3" autocomplete="off">
            </div>
            <div class="col-sm-4 messages"></div>
        </div>
        <div class="clearfixed"></div>
        <div class="row text-left">
            <button type="button" class="btn btn-labeled cancel_edit_basic_data"><b><i class="fa fa-times"></i></b>لغو</button>
            <button type="submit" class="btn bg-teal-400 btn-labeled"><b><i class="fa fa-save"></i></b>ذخیره</button>
        </div>
    </form>
</div>

<script>
    init_select2_data('#edit_parent_id', {!! LBDM_Get_BasicData_json() !!}, false, true, false, false, 'بدون والد...');
    $('#edit_parent_id').val({{ $basic_data->parent_id }}).trigger('change');
</script>