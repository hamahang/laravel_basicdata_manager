@if(isset($basicdata)&& $basicdata)
    <form id="FormUpdateBasicData">
        <div class="space-10"></div>
        <input type="hidden" name="id" value="{{$basicdata->id}}">
        <div class="form-group col-xs-12">
            <label class="col-sm-3 text-center">
                <span class="red-star">*</span>
                <span>والد:</span></label>
            <div class="col-sm-5">
                <select class="form-control" name="parent_id_edit" id="parent_id_edit">
                    <option value="{{$basicdata->parent_id}}">scc</option>
                </select>
            </div>
            <div class="col-sm-4" id="#error_title"></div>
        </div>
        <div class="form-group col-xs-12">
            <label class="col-sm-3 text-center"><span
                        class="red-star">*</span><span>عنوان:</span></label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="title" value="{{$basicdata->title}}"/>
            </div>
            <div class="col-sm-4" id="#error_title"></div>
        </div>
        <div class="form-group col-xs-12">
            <label class="col-sm-3 text-center"><span
                        class="red-star">*</span><span>عنوان مورد استفاده:</span>
            </label>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="dev_title" value="{{$basicdata->dev_title}}"/>
            </div>
            <div class="col-sm-4" id="#error_dev_title"></div>
        </div>
        <div class="form-group col-xs-12">
            <label class="col-sm-3 text-center"><span class="red-star"></span><span>توضیحات:</span>
            </label>
            <div class="col-sm-5">
                <textarea type="text" class="form-control" name="comment">{{$basicdata->comment}}</textarea>
            </div>
            <div class="col-sm-4" id="#error_comment"></div>
        </div>
        <div class="form-group col-xs-12">
            <label class="col-sm-3 text-center">
                <span class="red-star"></span>
                <span>داده های بیشتر:</span></label>
            <div class="col-sm-5">
                <input  type="text" class="form-control" name="extra_field" id="extra_field" value="{{$basicdata->extra_field}}"/>
            </div>
            <div class="col-sm-4" id="#error_title"></div>
        </div>
        <div class="form-group col-xs-12">
            <label class="col-sm-3 text-center">
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
            <div class="col-sm-4" id="#error_msg_is_active"></div>
        </div>
        <div class="form-group col-xs-12">
            <label class="col-sm-3"></label>
            <div class="col-sm-5 text-right">
                <input type="button" class="btn btn-warning" id="submit_update_basicdata" value="ویرایش"/>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </form>
@else
    <div>مورد مورد نظر شما یافت نشد</div>
@endif
<script>
    init_select2('#parent_id_edit', '{{route('LBDM.AutoCompleteBasicdat')}}', 'جستجو کنید ...');
    /*var data_parent ={id: 0,text: 'ریشه'};
    var newOption = new Option(data_parent.text, data_parent.id, true, true);
    $('#parent_id_edit').append(newOption).trigger('change');*/
</script>