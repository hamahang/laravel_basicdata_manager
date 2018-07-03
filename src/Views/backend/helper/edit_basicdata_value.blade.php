@if(isset($basicdata_value)&& $basicdata_value)
    <form id="FormUpdateBasicDataValue" class="form-horizontal">
        <div class="space-10"></div>
        <input type="hidden" name="id" value="{{$basicdata_value->id}}"/>
        <div class="form-group fg_basicdata_id col-12 row">
            <label class="col-sm-3 text-center">
                <span class="more_info"></span>
                <span class="red-star">*</span>
                <span>والد:</span>
            </label>
            <div class="col-sm-5">

                <select class="form-control" name="basicdata_id" id="select_basicdata">
                    @if(isset($basicdata) && $basicdata)
                        @foreach($basicdata as $basic)
                            <option value="{{$basic->id}}" @if($basic->id==$basicdata_value->parent->id) selected @endif>{{$basic->title}}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="col-sm-4 messages"></div>
        </div>
        <div class="form-group fg_title col-12 row">
            <label class="col-sm-3 text-center">
                <span class="more_info"></span>
                <span class="red-star">*</span>
                <span>عنوان:</span>
            </label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="title" value="{{$basicdata_value->title}}"/>
            </div>
            <div class="col-sm-4 messages"></div>
        </div>
        <div class="form-group fg_dev_title col-12 row">
            <label class="col-sm-3 text-center">
                <span class="more_info"></span>
                <span class="red-star">*</span>
                <span>عنوان مورد استفاده:</span>
            </label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="dev_title" value="{{$basicdata_value->dev_title}}"/>
            </div>
            <div class="col-sm-4 messages"></div>
        </div>
        <div class="form-group fg_dev_val col-12 row">
            <label class="col-sm-3 text-center">
                <span class="more_info"></span>
                <span class="red-star"></span>
                <span>مقدار ثابت:</span>
            </label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="dev_val" value="{{$basicdata_value->value}}"/>
            </div>
            <div class="col-sm-4 messages"></div>
        </div>
        <div class="form-group fg_comment col-12 row">
            <label class="col-sm-3 text-center">
                <span class="more_info"></span>
                <span class="red-star"></span>
                <span>توضیحات:</span></label>
            <div class="col-sm-5">
              <textarea type="text" class="form-control" name="comment">{{$basicdata_value->comment}}</textarea>
            </div>
            <div class="col-sm-4 messages"></div>
        </div>
        <div class="form-group col-12 fg_extra_field row">
            <label class="col-sm-3 text-center">
                <span class="more_info"></span>
                <span class="red-star"></span>
                <span>داده های بیشتر:</span></label>
            <div class="col-sm-5">
                <input  type="text" class="form-control" name="extra_field" id="extra_field" value="{{$basicdata_value->extra_field}}" />
            </div>
            <div class="col-sm-4 messages"></div>
        </div>
        <div class="form-group fg_is_active col-12 row">
            <label class="col-sm-3 text-center">
                <span class="more_info"></span>
                <span class="red-star">*</span>
                <span>وضعیت:</span>
            </label>
            <div class="col-sm-5 text-right">
                <input type="radio" name="is_active" value="1" @if($basicdata_value->is_active==1)checked @endif/>
                <span> فعال </span>
                <input type="radio" name="is_active" value="0" @if($basicdata_value->is_active==0)checked @endif/>
                <span> غیرفعال </span>
            </div>
            <div class="col-sm-4 messages"></div>
        </div>
        <div class="form-group fg_submit col-12 row">
            <div class="col-sm-5 col-sm-offset-3 text-right">
                <button type="submit" name="submit" id="submit_update_basicdata_value" class="btn btn-success hidden"></button>
            </div>
        </div>
    </form>
@else
    <div>مورد مورد نظر شما یافت نشد</div>
@endif
<script>
    var constraints_edit = {
        title: {
            presence: {message: '^<strong>عنوان الزامیست</strong>'}
        },
        dev_title: {
            presence: {message: '^<strong> عنوان مورد استفاده الزامیست</strong>'}
        },
        dev_val: {
            presence: {message: '^<strong>مقدار ثابت الزامیست</strong>'}
        },
        is_active: {
            presence: {message: '^<strong>انتخاب وضعیت الزامیست</strong>'}
        }
    };
    var form = document.querySelector("#FormUpdateBasicDataValue");
    init_validatejs(form, constraints_edit, showSuccessUpdate,'#FormUpdateBasicDataValue');
    function showSuccessUpdate(formElement) {
        var formData = new FormData(formElement);
        $.ajax({
            type: "POST",
            url: '{{ route('LBDM.UpdateBasicDataValue')}}',
            dataType: "json",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                if (data.success == true) {
                    $("#FormUpdateBasicDataValue .total_loader").remove();
                    $("#FormUpdateBasicDataValue").find('input:text, input:password, input:file,textarea').val('');
                    $("#FormUpdateBasicDataValue").find('select').val('0');
                    datatable_basicdata_value.ajax.reload();
                    $("#tab_list_basicdata_value a").click();
                    $("#tab_edit_basic_value").remove();
                }
                else {
                    $("#FormUpdateBasicDataValue .total_loader").remove();
                    showMessages(data.message, 'message_basic_data_value_insert', 'error', formElement);
                    showErrors(form, data.errors);
                }
            }
        });
    }

</script>