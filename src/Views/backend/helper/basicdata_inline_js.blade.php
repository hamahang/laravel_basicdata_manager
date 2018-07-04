{{--
<script>
   /* $.post('{{route('LBDM.GetJsTreeBasicdata')}}', function (data) {
        $('#jstree_basic').jstree({
            'core': {
                'data': window.JSON.parse(data)
            }
        });
    });*/
    var columns_filter = [
        {data: 'title', name: 'title', title: 'عنوان'},
        {data: 'dev_title', name: 'dev_title', title: 'عنوان مورد استفاده'},
        {data: 'comment', name: 'comment', title: 'توضیحات'},
        {data: 'count_basic', name: 'count_basic', "orderable": false, searchable: false, title: 'زیر مجموعه'},
        {
            title: 'ترتیب',
            data: 'order',
            name: 'order',
            searchable: false,
            mRender: function (data, type, full) {
                var order = datatable_basicdata.order();
                if (order[0][1] == 'desc') {
                    return '' +
                        '<button type="button" class="btn btn-sm bg-info-400 fas fa-level-up-alt reorder_basicdata" ' +
                        '   data-order_type="increase" ' +
                        '   data-id="' + full.id + '" ' +
                        '   data-parent_id="' + full.parent_id + '" >' +
                        '</button>' +
                        '<span class="order_number">' + full.order + '</span>' +
                        '<button type="button" class="btn btn-sm bg-info-800 fas fa-level-down-alt reorder_basicdata" ' +
                        '   data-order_type="decrease"' +
                        '   data-id="' + full.id + '" ' +
                        '   data-parent_id="' + full.parent_id + '" >' +
                        '</button>';
                }
                else {
                    return '' +
                        '<button type="button" class="btn btn-xs bg-info-400 fas fa-level-up-alt reorder_basicdata" ' +
                        '   data-order_type="decrease" ' +
                        '   data-id="' + full.id + '" ' +
                        '   data-parent_id="' + full.parent_id + '" >' +
                        '</button>' +
                        '<span class="order_number">' + full.order + '</span>' +
                        '<button type="button" class="btn btn-xs bg-info-800 fas fa-level-down-alt reorder_basicdata" ' +
                        '   data-order_type="increase"' +
                        '   data-id="' + full.id + '" ' +
                        '   data-parent_id="' + full.parent_id + '" >' +
                        '</button>';
                }
            }
        },
        {
            title: 'عملیات',
            data: '',
            orderable: false,
            searchable: false,
            mRender: function (data, type, full) {
                return '' +
                    '<button type="button" class="btn btn-danger btn-xs btn-operation basic_data_delete fa fa-times" title="حذف" data-id="' + full.id + '"></button>' + '' +
                    '<button type="button" class="btn btn-warning btn-xs btn-operation basic_data_edit fas fa-edit mr-3 color-white" title="ویرایش" data-title="' + full.title + '" data-id="' + full.id + '"></button>' +
                    '<button title="زیرمجموعه ها" class="btn btn-action jsPanels fas fa-th-list mr-3" data-href="{{route('LBDM.JSBasicDataValue')}}?basicdata_id=' + full.id + '"></button>';
            }
        }

    ];
    var columns = [
        {data: 'title', name: 'title', title: 'عنوان'},
        {data: 'dev_title', name: 'dev_title', title: 'عنوان مورد استفاده'},
        {data: 'comment', name: 'comment', title: 'توضیحات'},
        {data: 'count_basic', name: 'count_basic', "orderable": false, searchable: false, title: 'زیر مجموعه'},
        {
            data: '',
            "orderable": false,
            searchable: false,
            title: 'عملیات',
            mRender: function (data, type, full) {
                return '' +
                    '<button type="button" class="btn btn-danger btn-xs btn-operation basic_data_delete  fa fa-times" title="حذف" data-id="' + full.id + '"></button>' + '' +
                    '<button type="button" class="btn btn-warning btn-xs btn-operation fas fa-edit color-white" title="ویرایش" data-title="' + full.title + '" data-id="' + full.id + '"></button>' +
                    '<button title="زیرمجموعه ها" class="btn btn-primary btn-xs btn-operation jsPanels fas fa-th-list " data-href="{{route('LBDM.JSBasicDataValue')}}?basicdata_id=' + full.id + '"></button>';
            }
        }

    ];
    var ajax_url = '{!! route('LBDM.GetBasicData') !!}';
    dataTablesGrid('#basicdata_table', 'datatable_basicdata', ajax_url, columns);
    //------------------------------------------------------------------------------------------------------------------//
   {{--
    $(document).off("click", '.reorder_basicdata');
    $(document).on('click', '.reorder_basicdata', function () {
        var $this = $(this);
        var order_type = $this.data('order_type');
        var id = $this.data('id');
        var parent_id = $this.data('parent_id');
        reOrderBasicData(id, parent_id, order_type);
    });

    function reOrderBasicData(id, parent_id, order_type) {
        var result = false;
        $.ajax({
            type: "POST",
            url: '{{ route('LBDM.SaveOrderBasicdata')}}',
            dataType: "json",
            data: {id: id, parent_id: parent_id, order_type: order_type},
            success: function (data) {
                if (data.success == true) {
                    datatable_basicdata.ajax.reload();
                    result = true;
                }
            }
        });
        return result;
    }

    //------------------------------------------------------------------------------------------------------------------//


    $(document).off('click', '.basic_data_edit');
    $(document).on('click', '.basic_data_edit', function () {
        if ($("#tab_edit_basic").length == 0) {
            $("#nav_tabs").append('<li class="nav-item" id="tab_edit_basic">' +
                '<a class="nav-link active show" data-toggle="tab" href="#edit" > ' +
                '<span>ویرایش:</span><span id="span_title">' + $(this).attr('data-title') + '</span>' +
                '</a>' +
                '</li>');
        }
        else {
            $("#span_title").html($(this).attr('data-title'));
        }
        $("#tab_edit_basic a").click();
        $("#edit").addClass('active in show');
        $("#list").removeClass('active in');
        $("#new").removeClass('active');
        $("#tab_list a").removeClass('active');
        $.post('{{route('LBDM.ShowEditBasicdata')}}', {id: $(this).attr('data-id')}, function (data) {
            var arr = window.JSON.parse(data);
            if (arr.success == true) {
                $("#edit").html(arr.view);
            }
        });
    });

    var constraints_basicdata_insert = {
       title: {
         presence: {message: '^<strong>عنوان الزامیست</strong>'}
         },
        dev_title: {
         presence: {message: '^<strong>عنوان مورد استفاده الزامیست</strong>'}
         },
        is_active: {
         presence: {message: '^<strong>انتخاب وضعیت الزامیست</strong>'}
         }

    };
    var form_basicdata_insert = document.querySelector("#FormInsertBasicData");
    init_validatejs(form_basicdata_insert, constraints_basicdata_insert, showSuccessBasicdata);

    function showSuccessBasicdata(formElement) {
        var formData = new FormData(formElement);
        $.ajax({
            type: "POST",
            url: '{{route('LBDM.InsertBasicData')}}',
            dataType: "json",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                $("#FormInsertBasicData .total_loader").remove();
                if (data.success == true) {
                     $("#FormInsertBasicData").find('input:text, input:password, input:file,textarea').val('');
                     $("#FormInsertBasicData").find('select').val('0');
                     $('#tab_list a').click();
                    datatable_basicdata.ajax.reload();
                }
                else {
                     showMessages(data.message, 'insert_basicdata_form_id', 'error', formElement);
                     showErrors(formData, data.errors);
                }
            }
        });
    }

    $(document).on('click', '#submit_update_basicdata', function () {
        var formElement = document.querySelector('#FormUpdateBasicData');
        var formData = new FormData(formElement);
        $('#update_basicdata_form_id  .error_msg').html('');
        $("#update_basicdata_form_id  .input_with_validation_error").removeClass("input_with_validation_error");
        update_basicdata(formData);

    });

    function update_basicdata(FormData) {
        $.ajax({
            type: "POST",
            url: "{{route('LBDM.UpdateBasicData')}}",
            data: FormData,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function (data) {
                if (data.success == true) {
                    datatable_basicdata.ajax.reload();
                    $("#tab_list a").click();
                    $("#tab_edit_basic").remove();
                }
                else {
                    $.each(data.error, function (key, err) {
                        var input_name = err.e_key;
                        $("#update_basicdata_form_id input[name= " + input_name + " ]").addClass('input_with_validation_error');
                        $.each(err.e_values, function (key, value) {
                            $('#update_basicdata_form_id #error_msg_' + input_name).html(value.e_text);
                        });
                    });
                }
            }
            ,
            error: function (e) {

            }
        });
    }

    var state_filter = 0;
    $("#div_base_filter_basicdata").hide();
    $(document).on('click', '#basic_data_filter_icon', function () {
        if (state_filter == 0) {
            $("#div_base_filter_basicdata").fadeIn();
            state_filter = 1;
            $(this).css('color', '#16a4cf');
        }
        else {
            $("#div_base_filter_basicdata").hide();
            state_filter = 0;
            $(this).css('color', '#525252');
        }
    });

    init_select2_ajax('#select_parent', '{{route('LBDM.AutoCompleteBasicdat')}}', 'جستجو کنید ...');
    init_select2_ajax('#parent_id', '{{route('LBDM.AutoCompleteBasicdat')}}', false, false, true, 'جستجو کنید ...');
    var data_parent = {id: 0, text: 'ریشه'};
    var newOption = new Option(data_parent.text, data_parent.id, true, true);
    $('#parent_id').append(newOption).trigger('change');

    $(document).on('click', '#btn_filter_basicdata', function () {
        var filter_id = $("#select_parent option:selected").val() ? $("#select_parent option:selected").val() : 0;
        if (filter_id) {
            dataTablesGrid('#basicdata_table', 'datatable_basicdata', ajax_url, columns_filter, {filter_id: filter_id});
        }
        else{
            dataTablesGrid('#basicdata_table', 'datatable_basicdata', ajax_url, columns);
        }
    });


</script>
 --}}
<script>
    var columns_filter = [
        {data: 'title', name: 'title', title: 'عنوان'},
        {data: 'dev_title', name: 'dev_title', title: 'عنوان مورد استفاده'},
        {data: 'comment', name: 'comment', title: 'توضیحات'},
        {data: 'count_basic', name: 'count_basic', "orderable": false, searchable: false, title: 'زیر مجموعه'},
        {
            title: 'ترتیب',
            data: 'order',
            name: 'order',
            searchable: false,
            mRender: function (data, type, full) {
                var order = datatable_basicdata.order();
                if (order[0][1] == 'desc') {
                    return '' +
                        '<button type="button" class="btn btn-sm bg-info-400 fas fa-level-up-alt reorder_basicdata" ' +
                        '   data-order_type="increase" ' +
                        '   data-id="' + full.id + '" ' +
                        '   data-parent_id="' + full.parent_id + '" >' +
                        '</button>' +
                        '<span class="order_number">' + full.order + '</span>' +
                        '<button type="button" class="btn btn-sm bg-info-800 fas fa-level-down-alt reorder_basicdata" ' +
                        '   data-order_type="decrease"' +
                        '   data-id="' + full.id + '" ' +
                        '   data-parent_id="' + full.parent_id + '" >' +
                        '</button>';
                }
                else {
                    return '' +
                        '<button type="button" class="btn btn-xs bg-info-400 fas fa-level-up-alt reorder_basicdata" ' +
                        '   data-order_type="decrease" ' +
                        '   data-id="' + full.id + '" ' +
                        '   data-parent_id="' + full.parent_id + '" >' +
                        '</button>' +
                        '<span class="order_number">' + full.order + '</span>' +
                        '<button type="button" class="btn btn-xs bg-info-800 fas fa-level-down-alt reorder_basicdata" ' +
                        '   data-order_type="increase"' +
                        '   data-id="' + full.id + '" ' +
                        '   data-parent_id="' + full.parent_id + '" >' +
                        '</button>';
                }
            }
        },
        {
            title: 'عملیات',
            data: '',
            orderable: false,
            searchable: false,
            mRender: function (data, type, full) {
                return '' +
                    '<button type="button" class="btn btn-danger btn-xs btn-operation basic_data_delete fa fa-times" title="حذف" data-id="' + full.id + '"></button>' + '' +
                    '<button type="button" class="btn btn-warning btn-xs btn-operation basic_data_edit fas fa-edit  color-white" title="ویرایش" data-title="' + full.title + '" data-id="' + full.id + '"></button>' +
                    '<button title="زیرمجموعه ها" class="btn btn-primary btn-xs btn-operation jsPanels fas fa-th-list" data-href="{{route('LBDM.JSBasicDataValue')}}?basicdata_id=' + full.id + '"></button>';
            }
        }

    ];
    var columns = [
        {data: 'title', name: 'title', title: 'عنوان'},
        {data: 'dev_title', name: 'dev_title', title: 'عنوان مورد استفاده'},
        {data: 'comment', name: 'comment', title: 'توضیحات'},
        {data: 'count_basic', name: 'count_basic', "orderable": false, searchable: false, title: 'زیر مجموعه'},
        {
            data: '',
            "orderable": false,
            searchable: false,
            title: 'عملیات',
            mRender: function (data, type, full) {
                return '' +
                    '<button type="button" class="btn btn-danger btn-xs btn-operation basic_data_delete  fa fa-times" title="حذف" data-id="' + full.id + '"></button>' + '' +
                    '<button type="button" class="btn btn-warning btn-xs btn-operation fas fa-edit color-white basic_data_edit" title="ویرایش" data-title="' + full.title + '" data-id="' + full.id + '"></button>' +
                    '<button title="زیرمجموعه ها" class="btn btn-primary btn-xs btn-operation jsPanels fas fa-th-list" data-href="{{route('LBDM.JSBasicDataValue')}}?basicdata_id=' + full.id + '"></button>';
            }
        }
    ];
    var ajax_url = '{!! route('LBDM.GetBasicData') !!}';
    dataTablesGrid('#basicdata_table', 'datatable_basicdata', ajax_url, columns);


    var state_filter = 0;
    $("#div_base_filter_basicdata").hide();
    $(document).on('click', '#basic_data_filter_icon', function () {
        if (state_filter == 0) {
            $("#div_base_filter_basicdata").fadeIn();
            state_filter = 1;
            $(this).css('color', '#16a4cf');
        }
        else {
            $("#div_base_filter_basicdata").hide();
            state_filter = 0;
            $(this).css('color', '#525252');
        }
    });

    $(document).off('click', '.basic_data_delete');
    $(document).on('click', '.basic_data_delete', function () {
        var id = $(this).attr('data-id');
        $.confirm({
            title: 'حذف',
            content: 'آیا از حذف این مورد اطمینان دارید؟',
            type: 'red',
            buttons: {
                cancel: {
                    text: 'انصراف'
                },
                confirm: {
                    text: 'بله حذف شود',
                    btnClass: 'btn-red',
                    action: function () {
                        $.post('{{route('LBDM.DeleteBasicData')}}', {id: id}, function (data) {
                            var arr = JSON.parse(data);
                            datatable_basicdata.ajax.reload();
                        });
                    }
                }

            }
        });

    });

    $(document).off('click', '.basic_data_edit');
    $(document).on('click', '.basic_data_edit', function () {
        if ($("#tab_edit_basic").length == 0) {
            $("#nav_tabs").append('<li class="nav-item" id="tab_edit_basic" style="position: relative">' +
                '<a class="nav-link active show" data-toggle="tab" href="#edit" > ' +
                '<span>ویرایش:</span><span id="span_title">' + $(this).attr('data-title') + '</span>' +
                '<span class="fa fa-times delete_tab_ico"></span> ' +
                '</a>' +
                '</li>');
        }
        else {
            $("#span_title").html($(this).attr('data-title'));
        }
        $("#tab_edit_basic a").click();
        $("#edit").addClass('active in show');
        $("#list").removeClass('active in');
        $("#new").removeClass('active');
        $("#tab_list a").removeClass('active');
        $.post('{{route('LBDM.ShowEditBasicdata')}}', {id: $(this).attr('data-id')}, function (data) {
            var arr = window.JSON.parse(data);
            if (arr.success == true) {
                $("#edit").html(arr.view);
            }
        });
    });
    $(document).off('click', '.delete_tab_ico');

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
    var form = document.querySelector("#FormInsertBasicData");
    init_validatejs(form, constraints, showSuccessInsert, '#FormInsertBasicData');
    function showSuccessInsert(formElement) {
        var formData = new FormData(formElement);
        $.ajax({
            type: "POST",
            url: '{{route('LBDM.InsertBasicData')}}',
            dataType: "json",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                $("#FormInsertBasicData .total_loader").remove();
                if (data.success == true) {
                    $("#FormInsertBasicData").find('input:text, input:password, input:file,textarea').val('');
                    $("#FormInsertBasicData").find('select').val('0');
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

    var constraints_filter = {
        filter_id: {
            presence: {message: '^<strong>عنوان الزامیست</strong>'}
        }
    };
    var form = document.querySelector("#FormFilter");
    init_validatejs(form, constraints_filter, showSuccessFilter, '#FormFilter');
    function showSuccessFilter(formElement) {
        var formData = new FormData(formElement);
        var filter_id = $("#select_parent option:selected").val() ? $("#select_parent option:selected").val() : 0;
        datatable_basicdata.destroy();
        if (filter_id) {
            dataTablesGrid('#basicdata_table', 'datatable_basicdata', ajax_url, columns_filter, {filter_id: filter_id});
        }
        $("#FormFilter .total_loader").remove();
    }

    init_select2_ajax('#parent_id', '{{route('LBDM.AutoCompleteBasicdat')}}', false, false, true, 'جستجو کنید ...');
    init_select2_ajax('#select_parent', '{{route('LBDM.AutoCompleteBasicdat')}}', 'جستجو کنید ...');

    $(document).on('click', '#btn_filter_basicdata_cancel', function () {
        datatable_basicdata.destroy();
        $("#basicdata_table thead").remove();
        $("#basicdata_table tbody").remove();
        dataTablesGrid('#basicdata_table', 'datatable_basicdata', ajax_url, columns);
        $("#select_parent").val('').trigger('change')
    });

    //// reorder for basicdata datatable
    $(document).off("click", '.reorder_basicdata');
    $(document).on('click', '.reorder_basicdata', function () {
        var $this = $(this);
        var order_type = $this.data('order_type');
        var id = $this.data('id');
        var parent_id = $this.data('parent_id');
        reOrderBasicData(id, parent_id, order_type);
    });

    function reOrderBasicData(id, parent_id, order_type) {
        var result = false;
        $.ajax({
            type: "POST",
            url: '{{ route('LBDM.SaveOrderBasicdata')}}',
            dataType: "json",
            data: {id: id, parent_id: parent_id, order_type: order_type},
            success: function (data) {
                if (data.success == true) {
                    datatable_basicdata.ajax.reload();
                    result = true;
                }
            }
        });
        return result;
    }

</script>