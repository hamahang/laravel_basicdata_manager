<script>
    window.basicDataValueGridData = "";
    window.basicDataGridData = "";
    window['basic_data_grid_columns'] = [
        {
            "data": "id", 'title': 'ردیف',
            searchable: false,
            sortable: false,
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
        {
            data:'main_id',
            name:'main_id',
            title:'شناسه ' ,
        },
        {
            width: '30%',
            data: 'title', name: 'title', 'title': 'عنوان',
            mRender: function (data, type, full) {
                return '<a href="#"><span class="manage_basic_data_value" data-item_id="' + full.id + '" data-item_title="' + full.title + '" data-base_item="' + full.base_item + '">' + full.title + '</span></a>';
            }
        },
        {
            width: '35%',
            data: 'comment', name: 'comment', 'title': 'توضیحات',
            mRender: function (data, type, full) {
                return '<span title="' + full.comment + '">' + full.short_comment;
                +'</span>';
            }
        },
        {
            width: '20%',
            title: "ترتیب",
            data: 'order',
            name: 'order',
            mRender: function (data, type, full) {
                var order = basicDataGridData.order();
                if (order[0][0] == 3) {
                    if (order[0][1] == 'desc') {
                        var result = '';
                        result += '' +
                            '<div class="input-group mb-3">' +
                            '   <div class="input-group-prepend ">' +
                            '       <button type="button" style="float: right;border-radius: 0px;" class="btn btn-outline-secondary reorder_basicdata_item bg-info-400" ' +
                            '           data-order_type="increase" ' +
                            '           data-parent_id="' + full.parent_id + '"' +
                            '           data-item_id="' + full.id + '" >' +
                            '           <i class="fas fa-level-up-alt"></i>'  +
                            '       </button>' +
                            '   </div>' +
                            '   <input type="text" style="width: 35%;" class="form-control text-center" style="width:35% " disabled value="'+full.order+'">' +
                            '    <div class="input-group-append">' +
                            '       <button type="button" style="border-radius: 0px;" class="btn btn-outline-secondary reorder_basicdata_item bg-info-800" ' +
                            '           data-order_type="decrease"' +
                            '           data-parent_id="' + full.parent_id + '"' +
                            '           data-item_id="' + full.id + '" >' +
                            '       <i class="fas fa-level-down-alt fa-flip-horizontal"></i>' +
                            '   </button>';
                        '   </div>' +
                        '</div>';
                        return result;
                    }
                    else {
                        var result = ''+
                            '<div class="input-group mb-3">' +
                            '   <div class="input-group-prepend ">' +
                            '       <button type="button" style="float: right;border-radius: 0px;" class="btn btn-outline-secondary reorder_basicdata_item bg-info-400" ' +
                            '           data-order_type="decrease" ' +
                            '           data-parent_id="' + full.parent_id + '"' +
                            '           data-item_id="' + full.id + '" >' +
                            '           <i class="fas fa-level-up-alt"></i>'  +
                            '       </button>' +
                            '   </div>' +
                            '   <input type="text" class="form-control text-center" style="width:35% " disabled value="'+full.order+'">' +
                            '    <div class="input-group-append">' +
                            '       <button type="button" style="border-radius: 0px;" class="btn btn-outline-secondary reorder_basicdata_item bg-info-800" ' +
                            '           data-order_type="increase"' +
                            '           data-parent_id="' + full.parent_id + '"' +
                            '           data-item_id="' + full.id + '" >' +
                            '       <i class="fas fa-level-down-alt fa-flip-horizontal"></i>' +
                            '   </button>';
                        '   </div>' +
                        '</div>';
                        return result;
                    }
                }
                else {
                    return '<span class="order_number">' + full.order + '</span>';
                }
            }
        },
        {
            width: '25%',
            data: 'created_at', name: 'created_at', 'title': 'تاریخ ایجاد',
            mRender: function (data, type, full) {
                return '<span>' + full.created_at_jalali + '<span>';
            }
        },
        {
            width: '10%',
            searchable: false,
            sortable: false,
            data: 'action', name: 'action', 'title': 'عملیات',
            mRender: function (data, type, full) {
                var result = '';
                result += '' +
                    '<td class="text-center">' +
                    '   <ul class="icons-list">' +
                    '       <li class="dropdown" onclick="set_fixed_dropdown_menu(this)">' +
                    '           <a href="#" class="dropdown-toggle" data-toggle="dropdown">' +
                    '               <i class="icon-menu9"></i>' +
                    '           </a>' +
                    '           <ul class="dropdown-menu dropdown-menu-right">' +
                    '               <li><a class="manage_basic_data_value" data-item_id="' + full.id + '" data-item_title="' + full.title + '" data-base_item="' + full.base_item + '"><i class="fa fa-eye"></i>مشاهده مقادیر</a></li>' +
                    '               <li><a class="btn_grid_edit_item" data-title="' + full.title + '" data-item_id="' + full.id + '"><i class="fa fa-edit"></i>ویرایش</a></li>' +
                    '               <li><a class="btn_grid_delete_item" data-item_id="' + full.id + '"><i class="fa fa-times"></i>حذف</a></li>' +
                    '           </ul>' +
                    '       </li>' +
                    '   </ul>' +
                    '</td>';
                return result;
            }
        }
    ];
    window['basic_data_value_grid_columns'] = [
        {
            "data": "id", 'title': 'ردیف',
            searchable: false,
            sortable: false,
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
        {
            data:'id',
            name:'id',
            title:'آی دی ' ,
            visible:false
        },
        {
            width: '30%',
            data: 'title', name: 'title', 'title': 'عنوان',
            mRender: function (data, type, full) {
                return full.title;
            }
        },
        {
            width: '30%',
            data: 'comment', name: 'comment', 'title': 'توضیحات',
            mRender: function (data, type, full) {
                return full.comment;
            }
        },
        {
            width: '25%',
            title: "ترتیب",
            data: 'order',
            name: 'order',
            mRender: function (data, type, full) {
                var order = basicDataValueGridData.order();
                if (order[0][0] == 4) {
                    if (order[0][1] == 'desc') {
                        var result = '';
                        result += '' +
                            '<div class="input-group mb-3">' +
                            '   <div class="input-group-prepend ">' +
                            '       <button type="button" style="float: right;border-radius: 0px;" class="btn btn-outline-secondary reorder_basicdata_value_item bg-info-400" ' +
                            '           data-order_type="increase" ' +
                            '           data-basicdata_id="' + full.basicdata_id + '"' +
                            '           data-item_id="' + full.id + '" >' +
                            '           <i class="fas fa-level-up-alt"></i>'  +
                            '       </button>' +
                            '   </div>' +
                            '   <input type="text" style="width: 35%;" class="form-control text-center" style="width:35% " disabled value="'+full.order+'">' +
                            '    <div class="input-group-append">' +
                            '       <button type="button" style="border-radius: 0px;" class="btn btn-outline-secondary reorder_basicdata_value_item bg-info-800" ' +
                            '           data-order_type="decrease"' +
                            '           data-basicdata_id="' + full.basicdata_id + '"' +
                            '           data-item_id="' + full.id + '" >' +
                            '       <i class="fas fa-level-down-alt fa-flip-horizontal"></i>' +
                            '   </button>';
                        '   </div>' +
                        '</div>';
                        return result;
                    }
                    else {
                        var result = ''+
                            '<div class="input-group mb-3">' +
                            '   <div class="input-group-prepend ">' +
                            '       <button type="button" style="float: right;border-radius: 0px;" class="btn btn-outline-secondary reorder_basicdata_value_item bg-info-400" ' +
                            '           data-order_type="decrease" ' +
                            '           data-basicdata_id="' + full.basicdata_id + '"' +
                            '           data-item_id="' + full.id + '" >' +
                            '           <i class="fas fa-level-up-alt"></i>'  +
                            '       </button>' +
                            '   </div>' +
                            '   <input type="text" class="form-control text-center" style="width:35% " disabled value="'+full.order+'">' +
                            '    <div class="input-group-append">' +
                            '       <button type="button" style="border-radius: 0px;" class="btn btn-outline-secondary reorder_basicdata_value_item bg-info-800" ' +
                            '           data-order_type="increase"' +
                            '           data-basicdata_id="' + full.basicdata_id + '"' +
                            '           data-item_id="' + full.id + '" >' +
                            '       <i class="fas fa-level-down-alt fa-flip-horizontal"></i>' +
                            '   </button>';
                        '   </div>' +
                        '</div>';
                        return result;
                    }
                }
                else {
                    return '<span class="order_number">' + full.order + '</span>';
                }
            }
        },
        {
            width: '25%',
            data: 'created_at', name: 'created_at', 'title': 'تاریخ ایجاد',
            mRender: function (data, type, full) {
                return '<span>' + full.created_at_jalali + '<span>';
            }
        },
        {
            data:'main_id',
            name:'main_id',
            title:'شناسه ' ,
        },
        {
            width: '10%',
            searchable: false,
            sortable: false,
            data: 'action', name: 'action', 'title': 'عملیات',
            mRender: function (data, type, full) {
                var result = '';
                result += '' +
                    '<td class="text-center">' +
                    '   <ul class="icons-list">' +
                    '       <li class="dropdown" onclick="set_fixed_dropdown_menu(this)">' +
                    '           <a href="#" class="dropdown-toggle" data-toggle="dropdown">' +
                    '               <i class="icon-menu9"></i>' +
                    '           </a>' +
                    '           <ul class="dropdown-menu dropdown-menu-right">' +
                    '               <li><a class="btn_grid_edit_value_item" data-item_id="' + full.id + '" data-title="' + full.title +'"><i class="fa fa-edit"></i>ویرایش</a></li>' +
                    '               <li><a class="btn_grid_delete_value_item" data-item_id="' + full.id + '"><i class="fa fa-times"></i>حذف</a></li>' +
                    '           </ul>' +
                    '       </li>' +
                    '   </ul>' +
                    '</td>';
                return result;
            }
        }
    ];
    var getBasicDataRoute = '{{ route('LBDM.get_basic_data') }}';
    var getBasicDataValueRoute = '{{ route('LBDM.get_basic_data_value') }}';

    var constraints = {
        title: {
            presence: {message: '^<strong>عنوان داده اولیه الزامی است.</strong>'}
        }
    };
    var value_constraints = {
        title: {
            presence: {message: '^<strong>عنوان داده اولیه الزامی است.</strong>'}
        },
        // basicdata_id: {
        //     presence: {message: '^<strong>فیلد انتخاب مقدار اولیه الزامی است.</strong>'}
        // },
        // value: {
        //     presence: {message: '^<strong>مقدار داده اولیه الزامی است.</strong>'}
        // }
    };
    var create_basic_data_form = document.querySelector("#frm_add_new_basic_data");
    var create_basic_data_value_form = document.querySelector("#frm_create_basic_data_value");

    function create_basic_data(formElement) {
        var formData = new FormData(formElement);
        $.ajax({
            type: "POST",
            url: '{{ route('LBDM.create_basic_data')}}',
            dataType: "json",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
              $('#frm_add_new_basic_data .total_loader').remove();
                if (data.success) {
                    menotify('success',  data.title, data.message);
                    $('a[href="#manage_tab_basic_data"]').click();
                    basicDataGridData.ajax.reload(null,false);
                    clear_form_elements('#frm_add_new_basic_data');

                }
                else {
                    showMessages(data.message, 'form_message_box', 'error', formElement);
                    showErrors(formElement, data.errors);
                }
            }
        });
    }
    function create_basic_data_value(formElement) {
        var formData = new FormData(formElement);
        $.ajax({
            type: "POST",
            url: '{{ route('LBDM.create_basic_data_value')}}',
            dataType: "json",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
              $('#frm_create_basic_data_value .total_loader').remove();
                if (data.success) {
                    menotify('success', 'افزودن  مقدار داده اولیه', data.message);
                    clear_form_elements('#frm_create_basic_data_value');
                    $('a[href="#basic_data_value_list_div"]').click();
                    basicDataValueGridData.ajax.reload(null,false);
                }
                else {
                    showMessages(data.message, 'form_message_box', 'error', formElement);
                    showErrors(formElement, data.errors);

                }
            }
        });
    }
    function edit_basic_data(formElement) {
        var formData = new FormData(formElement);
        $.ajax({
            type: "POST",
            url: '{{ route('LBDM.edit_basic_data')}}',
            dataType: "json",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                if (data.success) {
                    menotify('success', 'ویرایش داده اولیه', data.message);
                    $('a[href="#manage_tab_basic_data"]').click();
                    $('.edit_basic_data').addClass('hide');
                    basicDataGridData.ajax.reload(null,false);
                }
                else {
                    showMessages(data.message, 'form_message_box', 'error', formElement);
                    showErrors(formElement, data.errors);
                }
            }
        });
    }
    function edit_basic_data_value(formElement) {
        var formData = new FormData(formElement);
        $.ajax({
            type: "POST",
            url: '{{ route('LBDM.edit_basic_data_value')}}',
            dataType: "json",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
              $('#frm_edit_basic_data_value .total_loader').remove();
                if (data.success) {
                    menotify('success', 'ویرایش مقدار داده اولیه', data.message);
                    $('a[href="#basic_data_value_list_div"]').click();
                    $('#tab_edit_basic_data_value').addClass('hide');
                    basicDataValueGridData.ajax.reload(null,false);
                }
                else {
                    showMessages(data.message, 'form_message_box', 'error', formElement);
                    showErrors(formElement, data.errors);
                }
            }
        });
    }
    init_validatejs(create_basic_data_form, constraints, create_basic_data);
    init_validatejs(create_basic_data_value_form, constraints, create_basic_data_value);

    function get_edit_basic_data_form(basic_data_id) {
        $.ajax({
            type: "POST",
            url: '{{ route('LBDM.get_basic_data_edit_form')}}',
            dataType: "json",
            data: {
                basic_data_id: basic_data_id
            },
            success: function (data) {
                if (data.success) {
                    $('#edit_basic_data_tab').html(data.edit_view);
                    $('#div_edit_basic_data').removeClass('hide');
                    $('a[href="#edit_basic_data_tab"]').click();
                    var edit_basic_data_form = document.querySelector("#frm_edit_basic_data");
                    init_validatejs(edit_basic_data_form, constraints, edit_basic_data);
                }
                else {
                    showMessages(data.message, 'form_message_box', 'error', formElement);
                    showErrors(formElement, data.errors);

                }
            }
        });
    }

    function delete_basic_data(data) {
        $.ajax({
            type: "POST",
            url: '{{ route('LBDM.delete_basic_data')}}',
            dataType: "json",
            data: {
                basic_data_id: data.item_id
            },
//            processData: false,
//            contentType: false,
            success: function (data) {
                if (data.success) {
                    menotify('success', 'حذف داده اولیه', data.message);
                    basicDataGridData.ajax.reload(null,false);
//                    showMessages(data.message, 'form_message_box', 'error');
//                    showErrors(formElement, data.errors);
                }
                else {
//                    showMessages(data.message, 'form_message_box', 'success');

                }
            }
        });
    }

    function delete_basic_data_value(data) {
        $.ajax({
            type: "POST",
            url: '{{ route('LBDM.delete_basic_data_value')}}',
            dataType: "json",
            data: {
                basic_data_value_id: data.item_id
            },
//            processData: false,
//            contentType: false,
            success: function (data) {
                if (data.success) {
                    menotify('success', 'حذف مقدار داده اولیه', data.message);
                    basicDataValueGridData.ajax.reload(null,false);
//                    showMessages(data.message, 'form_message_box', 'error');
//                    showErrors(formElement, data.errors);
                }
                else {
//                    showMessages(data.message, 'form_message_box', 'success');

                }
            }
        });
    }

    function get_edit_basic_data_value_form(basic_data_value_id) {
        $.ajax({
            type: "POST",
            url: '{{ route('LBDM.get_basic_data_value_edit_form')}}',
            dataType: "json",
            data: {
                basic_data_value_id: basic_data_value_id
            },
//            processData: false,
//            contentType: false,
            success: function (data) {
                if (data.success) {
                    $('#edit_basic_data_value_tab').html(data.basic_data_value_view);
                    $('#tab_edit_basic_data_value').removeClass('hide');
                    $('a[href="#edit_basic_data_value_tab"]').click();
                    //---------------------------summernotes-------------------------------------------------------------------------------
                    $('.hideSummernotes').hide();
                    $('#edit_basic_data_value_textarea').hide();
                    $(document).off('click', '.showSummernotes');
                    $(document).on('click', '.showSummernotes', function () {
                        $('#edit_basic_data_value_textarea').summernote({
                            lang:'fa-IR',
                            height: 200
                        });
                        $('.hideSummernotes').show();
                        $('.showSummernotes').hide();
                        $('#edit_basic_data_value_value').addClass('hide');
                        $('#edit_basic_data_value_textarea').removeClass('hide');
                        $('#edit_basic_data_value_value').attr('disabled','disabled');
                        $('#edit_basic_data_value_textarea').removeAttr('disabled');


                    });
                    $(document).off('click', '.');
                    $(document).on('click', '.hideSummernotes', function () {
                        $('#edit_basic_data_value_textarea').summernote('destroy');
                        $('#edit_basic_data_value_textarea').attr('disabled','disabled');
                        $('#edit_basic_data_value_value').removeClass('hide');
                        $('#edit_basic_data_value_textarea').addClass('hide');
                        $('#edit_basic_data_value_value').removeAttr('disabled');
                        $('.showSummernotes').show();
                        $('.hideSummernotes').hide();

                    });
                    var edit_basic_data_value_form = document.querySelector("#frm_edit_basic_data_value");
                    init_validatejs(edit_basic_data_value_form, value_constraints, edit_basic_data_value);
                }
                else {
                    showMessages(data.message, 'form_message_box', 'error', formElement);
                    showErrors(formElement, data.errors);
                }
            }
        });
    }

    $(document).ready(function () {
        dataTablesGrid('#basicDataGridData', 'basicDataGridData', getBasicDataRoute, basic_data_grid_columns);
        basicDataGridData.columns([3]).visible(false);
        init_select2_data('#parent_id', {!! LBDM_Get_BasicData_json() !!}, false, true, false, false, 'بدون والد...');

        $(document).on('click', '.btn_grid_edit_item', function () {
            var item_id = $(this).data('item_id');
            var title = $(this).data('title');
            $('a[href="#edit_basic_data_tab"]').html('ویرایش : '+title);
            get_edit_basic_data_form(item_id);
        });

        $(document).on('click', '.btn_grid_delete_item', function () {
            var item_id = $(this).data('item_id');
            yesNoAlert('حذف داده اولیه', 'از حذف داده اولیه مطمئن هستید؟', 'warning', 'بله، حذف شود!', 'لغو', delete_basic_data, {item_id: item_id});
        });

        $(document).on('click', '.btn_grid_delete_value_item', function () {
            var item_id = $(this).data('item_id');
            yesNoAlert('حذف مقدار داده اولیه', 'از حذف مقدار داده اولیه مطمئن هستید؟', 'warning', 'بله، حذف شود!', 'لغو', delete_basic_data_value, {item_id: item_id});
        });

        $(document).on('click', '.btn_grid_edit_value_item', function () {
            var item_id = $(this).data('item_id');
            var title = $(this).data('title');
            $('a[href="#edit_basic_data_value_tab"]').html('ویرایش : '+title);
            get_edit_basic_data_value_form(item_id);
        });

        $(document).on('click', '.cancel_create_basic_data', function () {
            document.getElementById('frm_add_new_basic_data').reset();
            $('#parent_id').val('').trigger('change');
            $('a[href="#manage_tab_basic_data"]').click();
        });

        $(document).on('click', '.cancel_edit_basic_data', function () {
            $('#div_edit_basic_data').addClass('hide');
            $("#tab_link_manage_basic_data_tab").click();
        });

        $(document).on('click', '.cancel_edit_basic_data_value', function () {
            document.getElementById('frm_edit_basic_data_value').reset();
            $('#tab_edit_basic_data_value').addClass('hide');
            $('a[href="#basic_data_value_list_div"]').click();
        });
        $(document).on('click', '.cancel_create_basic_data_value', function () {
            document.getElementById('frm_create_basic_data_value').reset();
            $('a[href="#basic_data_value_list_div"]').click();
        });
        $(document).off('click', '.manage_basic_data_value');
        $(document).on('click', '.manage_basic_data_value', function () {
            var item_id = $(this).data('item_id');
            $('#basicdata_id_hidden').val(item_id) ;
            var item_title = $(this).data('item_title');
            var base_item = $(this).data('base_item');
            var basic_data_value_table_div = '' +
                '<div class="col-xs-12" id="basic_data_value_table_div">' +
                '   <table id="basicDataValueGridData" class="table" width="100%"></table>' +
                '</div>';
            $('#basic_data_value_list_div').html(basic_data_value_table_div);
            $('.manage_value_tab_div').removeClass('hide');
            $('.manage_basic_data_value_title').html('<span>مدیریت آیتم های :</span><span> '+item_title+' </span>');
            $('a[href="#manage_basic_data_value_tab"]').click();

            dataTablesGrid('#basicDataValueGridData', 'basicDataValueGridData', getBasicDataValueRoute, basic_data_value_grid_columns, {basic_data_id: item_id}, null, true, null, null, 1, 'desc');
            init_select2_data('#basic_data_value_parent_id', {!! LBDM_Get_BasicData_json() !!}, false, false, false, false, 'داده اولیه...');
            $('#basic_data_value_parent_id').val(base_item).trigger('change');
        });

        $(document).on('click', '.btn_close_values_list_tab', function () {
          $('.manage_value_tab_div').addClass('hide');
          $('a[href="#manage_tab_basic_data"]').click();
        });
    });
    /*-------------------------------------------------Oreder--------------------------------------------------------------------------------------------------------*/
    $(document).off("click", '.reorder_basicdata_value_item');
    $(document).on('click', '.reorder_basicdata_value_item', function () {
        var $this = $(this);
        var order_type = $this.data('order_type');
        var item_id = $this.data('item_id');
        var basicdata_id = $this.data('basicdata_id');
        reOrderBasicdataValueItem(item_id, order_type,basicdata_id);
    });

    function reOrderBasicdataValueItem(item_id, order_type,basicdata_id) {
        var result = false;
        $.ajax({
            type: "POST",
            url: '{{ route('LBDM.save_order_basicdata_value_item')}}',
            dataType: "json",
            data: {item_id:item_id, order_type: order_type,basicdata_id:basicdata_id},
            success: function (data) {
                if (data.success) {
                    window.basicDataValueGridData.ajax.reload(null,false);
                    result = true;
                }
            }
        });
        return result;
    }
    //-------------------------------------------------------------------------------------
    $(document).off("click", '.reorder_basicdata_item');
    $(document).on('click', '.reorder_basicdata_item', function () {
        var $this = $(this);
        var order_type = $this.data('order_type');
        var item_id = $this.data('item_id');
        var parent_id = $this.data('parent_id');
        reOrderBasicdataItem(item_id, order_type,parent_id);
    });

    function reOrderBasicdataItem(item_id, order_type,parent_id) {
        var result = false;
        $.ajax({
            type: "POST",
            url: '{{ route('LBDM.save_order_basicdata_item')}}',
            dataType: "json",
            data: {item_id:item_id, order_type: order_type,parent_id:parent_id},
            success: function (data) {
                if (data.success) {
                    window.basicDataGridData.ajax.reload(null,false);
                    result = true;
                }
            }
        });
        return result;
    }
    /*-------------------------------------------------Filter--------------------------------------------------------------------------------------------------------*/
    $(document).off("click", '.btn_filter_datatables');
    $(document).on("click", ".btn_filter_datatables", function () {
        $('.forms_datatable_filters').fadeToggle(200);
    });
    $('#filter_process').change(function () {
        $('.basic_data_grid_data_div').empty();
        basicDataGridData.destroy();
        var basic_data_grid_data_div = '' +
            '<div class="col-xs-12 basic_data_grid_data_div">' +
            '   <table id="basicDataGridData" class="table" width="100%"></table>' +
            '</div>';
        $('#basic_data_grid_data_div_parent').html(basic_data_grid_data_div);
        dataTablesGrid('#basicDataGridData', 'basicDataGridData', getBasicDataRoute, basic_data_grid_columns,
            {item_id: $(this).val()});
        basicDataGridData.columns([3]).visible(false);
        if ($(this).val() > 0) {
            basicDataGridData.columns([3]).visible(true);
        }
    });
    //---------------------------select2-------------------------------------------------------------------------------
    init_select2_data('#filter_process', {!! $basicData !!});

    $('.hide_summernotes').hide();
    $('#basic_data_value_textarea').hide();
    $(document).off('click', '.show_summernotes');
    $(document).on('click', '.show_summernotes', function () {
        $('#basic_data_value_textarea').summernote({
            lang:'fa-IR',
            height: 200
        });
        $('.hide_summernotes').show();
        $('.show_summernotes').hide();
        $('#basic_data_value_value').addClass('hide');
        $('#basic_data_value_textarea').removeClass('hide');
        $('#basic_data_value_value').attr('disabled','disabled');
        $('#basic_data_value_textarea').removeAttr('disabled');


    });
    $(document).off('click', '.hide_summernotes');
    $(document).on('click', '.hide_summernotes', function () {
        $('#basic_data_value_textarea').summernote('destroy');
        $('#basic_data_value_textarea').attr('disabled','disabled');
        $('#basic_data_value_value').removeClass('hide');
        $('#basic_data_value_textarea').addClass('hide');
        $('#basic_data_value_value').removeAttr('disabled');
        $('.show_summernotes').show();
        $('.hide_summernotes').hide();

    });

</script>