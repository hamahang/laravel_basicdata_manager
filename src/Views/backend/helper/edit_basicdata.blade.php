@if(isset($basicdata)&& $basicdata)
    <div id="message_basic_data_value_update" class="form_message_area"></div>
    <div class="space-10"></div>
    <form id="FormUpdateBasicData" class="form-horizontal inner_tab col-12 relative">
        <input type="hidden" name="id" value="{{$basicdata->id}}">
        <div class="form-group col-12 row fg_parent_id_edit">
            <label class="col-sm-3 text-center control-label label_title" for="parent_id_edit">
                <span class="more_info"></span>
                <span class="red-star"></span>
                <span>والد:</span>
             </label>
            <div class="col-sm-5">
                <select class="form-control" name="parent_id" id="parent_id_edit">
                    <option value="0">انتخاب کنید</option>
                    @foreach($basicdatas as $basic)
                        <option value="{{$basic->id}}" @if($basic->id==$basicdata->parent_id) selected @endif>{{$basic->title}}</option>
                     @endforeach
                </select>
            </div>
            <div class="col-sm-4 messages"></div>
        </div>
        <div class="form-group col-12 row fg_title">
            <label class="col-sm-3 text-center control-label" for="title_edit">
                <span class="more_info"></span>
                <span class="more_info"></span>
                <span class="red-star">*</span>
                <span>عنوان:</span>
            </label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="title" id="title_edit" value="{{$basicdata->title}}"/>
            </div>
            <div class="col-sm-4 messages"></div>
        </div>
        <div class="form-group col-12 row fg_dev_title">
            <label class="col-sm-3 text-center" for="dev_tilte_edit">
                <span class="more_info"></span>
                <span class="red-star">*</span>
                <span>عنوان مورد استفاده:</span>
            </label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="dev_title" id="dev_tilte_edit" value="{{$basicdata->dev_title}}"/>
            </div>
            <div class="col-sm-4 messages"></div>
        </div>
        <div class="form-group col-12 row fg_comment">
            <label class="col-sm-3 text-center" for="comment_edit">
                <span class="more_info"></span>
                <span class="red-star"></span>
                <span>توضیحات:</span>
            </label>
            <div class="col-sm-5">
                <textarea type="text" class="form-control" name="comment" id="comment_edit">{{$basicdata->comment}}</textarea>
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
                <textarea type="text" class="form-control" name="dev_comment" id="dev_comment_edit">{{$basicdata->dev_comment}}</textarea>
            </div>
            <div class="col-sm-4 messages"></div>
        </div>
        <div class="form-group col-12 row fg_extra_field">
            <label class="col-sm-3 text-center" for="extra_field_edit">
                <span class="more_info"></span>
                <span class="red-star"></span>
                <span>داده های بیشتر:</span></label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="extra_field" id="extra_field_edit" value="{{$basicdata->extra_field}}"/>
            </div>
            <div class="col-sm-4 messages"></div>
        </div>
        <div class="form-group col-12 row fg_is_active">
            <label class="col-sm-3 text-center">
                <span class="more_info"></span>
                <span class="red-star">*</span>
                <span>وضعیت:</span>
            </label>
            <div class="col-sm-5 text-right">
                <span>
                    <input type="radio" name="is_active" value="1" @if($basicdata->is_active==1) checked @endif/>
                    <span> فعال </span>
                </span>
                <span>
                    <input type="radio" name="is_active" @if($basicdata->is_active==0) checked @endif value="0"/>
                    <span> غیرفعال </span>
                </span>
            </div>
            <div class="col-sm-4 messages"></div>
        </div>
        <div class="form-group col-12 row ">
            <label class="col-sm-3"></label>
            <div class="col-sm-5 text-right">
                <button type="submit" name="submit" class="btn btn-secondary" id="submit_update_basicdata">ویرایش</button>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </form>
@else
    <div>مورد مورد نظر شما یافت نشد</div>
@endif
<script>
    $(document).on('click', '.delete_tab_ico', function () {
        $(this).parent().parent().remove();
        $('#tab_list a').click();
    });

    var constraints = {
        title: {
            presence: {message: '^<strong>عنوان الزامیست</strong>'}
        },
        dev_title: {
            presence: {message: '^<strong> عنوان مورد استفاده الزامیست</strong>'}
        },
        is_active: {
            presence: {message: '^<strong>انتخاب وضعیت الزامیست</strong>'}
        }
    };
    var form = document.querySelector("#FormUpdateBasicData");
    init_validatejs(form, constraints, showSuccessUpdate,'#FormUpdateBasicData');
    function showSuccessUpdate(formElement) {
        var formData = new FormData(formElement);
        $.ajax({
            type: "POST",
            url: '{{route('LBDM.UpdateBasicData')}}',
            dataType: "json",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                $("#FormUpdateBasicData .total_loader").remove();
                if (data.success == true) {
                    $("#FormUpdateBasicData").find('input:text, input:password, input:file,textarea').val('');
                    $("#FormUpdateBasicData").find('select').val('0');
                    $('#tab_list a').click();
                    $("#tab_edit_basic").remove();
                    datatable_basicdata.ajax.reload();
                }
                else {
                    showMessages(data.message, 'insert_basicdata_form_id', 'error', formElement);
                    showErrors(formData, data.errors);
                }
            }
        });
    }


    /*var data_parent ={id: 0,text: 'ریشه'};
    var newOption = new Option(data_parent.text, data_parent.id, true, true);
    $('#parent_id_edit').append(newOption).trigger('change');*/
</script>