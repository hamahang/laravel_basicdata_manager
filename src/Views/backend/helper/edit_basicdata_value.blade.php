@if(isset($basicdata_value)&& $basicdata_value)
    <form id="FormUpdateBasicDataValue">
        <div class="space-10"></div>
        <input type="hidden" name="id" value="{{$basicdata_value->id}}"/>
        <div class="form-group col-xs-12">
            <lable class="col-sm-3 text-center">
                <span class="red-star">*</span>
                <span>والد:</span>
            </lable>
            <div class="col-sm-5">

                <select class="form-control" name="basicdata_id" id="select_basicdata">
                    @if(isset($basicdata) && $basicdata)
                        @foreach($basicdata as $basic)
                            <option value="{{$basic->id}}" @if($basic->id==$basicdata_value->parent->id) selected @endif>{{$basic->title}}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="col-sm-4" id="#error_title"></div>
        </div>
        <div class="form-group col-xs-12">
            <lable class="col-sm-3 text-center">
                <span class="red-star">*</span>
                <span>عنوان:</span>
            </lable>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="title" value="{{$basicdata_value->title}}"/>
            </div>
            <div class="col-sm-4" id="#error_title"></div>
        </div>
        <div class="form-group col-xs-12">
            <lable class="col-sm-3 text-center">
                <span class="red-star">*</span>
                <span>عنوان مورد استفاده:</span>
            </lable>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="dev_title" value="{{$basicdata_value->dev_title}}"/>
            </div>
            <div class="col-sm-4" id="#error_dev_title"></div>
        </div>
        <div class="form-group col-xs-12">
            <lable class="col-sm-3 text-center">
                <span class="red-star"></span>
                <span>مقدار ثابت:</span>
            </lable>
            <div class="col-sm-5">
                <input type="text" class="form-control" name="dev_val" value="{{$basicdata_value->value}}"/>
            </div>
            <div class="col-sm-4" id="#error_dev_val"></div>
        </div>
        <div class="form-group col-xs-12">
            <lable class="col-sm-3 text-center"><span class="red-star"></span><span>توضیحات:</span></lable>
            <div class="col-sm-5">
              <textarea type="text" class="form-control" name="comment">{{$basicdata_value->comment}}</textarea>
            </div>
            <div class="col-sm-4" id="#error_comment"></div>
        </div>
        <div class="form-group col-xs-12">
            <lable class="col-sm-3 text-center">
                <span class="red-star"></span>
                <span>داده های بیشتر:</span></lable>
            <div class="col-sm-5">
                <input  type="text" class="form-control" name="extra_field" id="extra_field" value="{{$basicdata_value->extra_field}}" />
            </div>
            <div class="col-sm-4" id="#error_title"></div>
        </div>
        <div class="form-group  col-xs-12">
            <lable class="col-sm-3 text-center">
                <span class="red-star">*</span><span>وضعیت:</span>
            </lable>
            <div class="col-sm-5 text-right">
                <input type="radio" name="is_active" value="1" @if($basicdata_value->is_active==1)checked @endif/>
                <span> فعال </span>
                <input type="radio" name="is_active" value="0" @if($basicdata_value->is_active==0)checked @endif/>
                <span> غیرفعال </span>
            </div>
            <div class="col-sm-4" id="#error_msg_is_active"></div>
        </div>
        <div class="form-group col-xs-12">
            <lable class="col-sm-3"></lable>
            <div class="col-sm-5 text-right">
                <input type="hidden" class="btn btn-success" id="submit_update_basicdata_value" value="ثبت"/>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </form>
@else
    <div>مورد مورد نظر شما یافت نشد</div>
@endif