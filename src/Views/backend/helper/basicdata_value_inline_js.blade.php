<script src="{{asset('vendor/LBDM/js/select2.min.js')}}"></script>
<script>

   /* var datatable_basicdata_value;*/
    var columns=[
        {data: 'title', name: 'title', title: 'عنوان',width:'20%'},
        {data: 'dev_title', name: 'dev_title', title: 'عنوان مورد استفاده',width:'20%'} ,
        {data: 'comment', name: 'comment', title: 'توضیحات',width:'25%'},
        {data: 'value', name: 'value', title: 'مقدار',width:'10%'},
        {
            title: "ترتیب",
            data: 'order',
            name: 'order',
            width:'15%',
            mRender: function (data, type, full) {
                var order = datatable_basicdata_value.order();
                if(order[0][1]=='desc') {
                    return '<button type="button" class="btn btn-sm bg-info-400 fas fa-level-up-alt reorder_basicdata_value" ' +
                        '      data-order_type="increase" ' +
                        '      data-id="' + full.id + '" ' +
                        '     data-basicdata_id="' + full.basicdata_id + '" >' +
                        '   </button>' +
                        '<span class="order_number">' + full.order + '</span>' +
                        ' <button type="button" class="btn btn-sm bg-info-800 fas fa-level-down-alt reorder_basicdata_value" ' +
                        '      data-order_type="decrease"' +
                        '       data-id="' + full.id + '"' +
                        '       data-basicdata_id="' + full.basicdata_id + '" >' +
                        '   </button>';
                }
                else{
                    return '<button type="button" class="btn btn-sm bg-info-400 fas fa-level-up-alt reorder_basicdata_value" ' +
                        '      data-order_type="decrease" ' +
                        '      data-id="' + full.id + '" ' +
                        '     data-basicdata_id="' + full.basicdata_id + '" >' +
                        '   </button>' +
                        '<span class="order_number">' + full.order + '</span>' +
                        ' <button type="button" class="btn btn-sm bg-info-800 fas fa-level-down-alt reorder_basicdata_value" ' +
                        '      data-order_type="increase"' +
                        '       data-id="' + full.id + '"' +
                        '       data-basicdata_id="' + full.basicdata_id + '" >' +
                        '   </button>';
                }
            }
        },
        {
            data: '',
            "orderable": false,
            searchable: false,
            title: 'عملیات',
            width:'10%',
            mRender: function (data, type, full) {
                return '<button type="button" class="btn btn-danger btn-sm btn-operation basicdata_value_delete  fa fa-times" data-id="' + full.id + '"></button>' + '' +
                    '<button type="button" class="btn btn-warning btn-sm btn-operation basicdata_value_edit fa fa-edit color-white" data-title="' + full.title + '" data-id="' + full.id + '" databasic-id=""></button>';
            }
        }
    ];
    var ajax_url='{{route('LBDM.GetBasicDataValue')}}';
    dataTablesGrid('#basicdata_value_table', 'datatable_basicdata_value', ajax_url, columns,{basicdata_id:{{$basic_id}}});
    {{-- datatable_basicdata_value = $('#basicdata_value_table').DataTable({
        processing: true,
        serverSide: true,
        language: {

            "sEmptyTable": "هیچ داده ای در جدول وجود ندارد",
            "sInfo": "نمایش _START_ تا _END_ از _TOTAL_ رکورد",
            "sInfoEmpty": "نمایش 0 تا 0 از 0 رکورد",
            "sInfoFiltered": "(فیلتر شده از _MAX_ رکورد)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "نمایش _MENU_ رکورد",
            "sLoadingRecords": "در حال بارگزاری...",
            "sProcessing": "در حال پردازش...",
            "sSearch": "جستجو",
            "sZeroRecords": "رکوردی با این مشخصات پیدا نشد",
            "oPaginate": {
                "sFirst": "Erste",
                "sPrevious": "قبلی",
                "sNext": "بعدی",
                "sLast": "Letzte"
            },
            "oAria": {
                "sSortAscending": ": فعال سازی نمایش به صورت صعودی",
                "sSortDescending": ": فعال سازی نمایش به صورت نزولی"
            }
        }
        ,
        columnDefs: [
            {type: 'string', targets: 0}
        ],
        ajax: {
            url: '{{route('LBDM.GetBasicDataValue')}}',
            type: 'post',
            data: {
                "basicdata_id":{{$basic_id}}
            }
        },

    });--}}
   //------------------------------------------------------------------------------------------------------------------//
   $(document).off("click", '.reorder_basicdata_value');
   $(document).on('click', '.reorder_basicdata_value', function () {
       var $this = $(this);
       var order_type = $this.data('order_type');
       var id = $this.data('id');
       var basicdata_id = $this.data('basicdata_id');
       reOrderBasicDataValue(id, basicdata_id, order_type);
   });
   function reOrderBasicDataValue(basid_data_value_id, basic_data_id, order_type) {
       var result = false;
       $.ajax({
           type: "POST",
           url: '{{ route('LBDM.SaveOrderBasicdataValue')}}',
           dataType: "json",
           data: {basicdata_value_id: basid_data_value_id, basicdata_id: basic_data_id, order_type: order_type},
           success: function (data) {
               if (data.success == true) {
                   window.datatable_basicdata_value.ajax.reload();
                   result = true;
               }
           }
       });
       return result;
   }
   //------------------------------------------------------------------------------------------------------------------//
    $(document).off('click', '.basicdata_value_delete');
    $(document).on('click', '.basicdata_value_delete', function () {
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
                        $.post('{{route('LBDM.DeleteBasicDataValue')}}', {id: id}, function (data) {
                            var arr = JSON.parse(data);
                            datatable_basicdata_value.ajax.reload();
                        });
                    }
                }

            }
        });

    });

    $(document).off('click', '.basicdata_value_edit');
    $(document).on('click', '.basicdata_value_edit', function () {

        if ($("#tab_edit_basic_value").length == 0) {
            $("#nav_tabs_value").append('<li class="nav-item" id="tab_edit_basic_value">' +
                '<a class="nav-link active show" data-toggle="tab" href="#edit_basicdata_value" > ' +
                '<span>ویرایش:</span><span id="span_title">' + $(this).attr('data-title') + '</span>' +
                '</a>' +
                '</li>');
        }
        else {
            $("#span_title").html($(this).attr('data-title'));
        }
        $("#tab_edit_basic_value a").click();
        $("#edit_basicdata_value").addClass('active in show');
        $("#list_basicdata_value").removeClass('active in');
        $("#new_basicdata_value").removeClass('active');
        $("#tab_list_basicdata_value a").removeClass('active');
        $.post('{{route('LBDM.ShowEditBasicdatValue')}}', {id: $(this).attr('data-id')}, function (data) {
            var arr = window.JSON.parse(data);
            if (arr.success == true) {
                $("#edit_basicdata_value").html(arr.view);
            }
        });

    });

/*    $(document).off('click', '#submit_insert_basicdata_value');
    $(document).on('click', '#submit_insert_basicdata_value', function () {
        var formElement = document.querySelector('#FormInsertBasicDataValue');
        var formData = new FormData(formElement);
        $('#FormInsertBasicDataValue  .error_msg').html('');
        $("#FormInsertBasicDataValue  .input_with_validation_error").removeClass("input_with_validation_error");
        insert_basicdata_value(formData);
    });*/

    $(document).off('click', '#submit_update_basicdata_value');
    $(document).on('click', '#submit_update_basicdata_value', function () {
        var formElement = document.querySelector('#FormUpdateBasicDataValue');
        var formData = new FormData(formElement);
        $('#FormUpdateBasicDataValue  .error_msg').html('');
        $("#FormUpdateBasicDataValue  .input_with_validation_error").removeClass("input_with_validation_error");
        update_basicdata_value(formData);
    });
    function update_basicdata_value(FormData) {
        $.ajax({
            type: "POST",
            url: "{{route('LBDM.UpdateBasicDataValue')}}",
            data: FormData,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function (data) {
                if (data.success == true) {
                    window.datatable_basicdata_value.ajax.reload();
                    $("#tab_list_basicdata_value a").click();
                    $("#tab_edit_basic_value").remove();
                    $("#FormUpdateBasicDataValue .message").html('ویرایش با موفقیت انجام شد');
                    setTimeout(function () {
                        $("#FormUpdateBasicDataValue .messsage").html('')
                    }, 3000);
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
            },
            error: function (e) {
            }
        });
    }

   {{--function insert_basicdata_value(FormData) {
        $.ajax({
            type: "POST",
            url: "{{route('LBDM.InsertBasicDataValue')}}",
            data: FormData,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function (data) {
                if (data.success == true) {
                    window.datatable_basicdata_value.ajax.reload();
                    $("#tab_list a").click();
                    $("#tab_edit_basic").remove();
                    $("#FormInsertBasicDataValue").find("input[type=text], textarea").val("");
                    $("#FormInsertBasicDataValue .messsage").html('ثبت با موفقیت انجام شد');
                    setTimeout(function () {
                        $("#FormInsertBasicDataValue .messsage").html('')
                    }, 3000);
                }
                else {
                    $.each(data.error, function (key, err) {
                        var input_name = err.e_key;
                        $("#FormInsertBasicDataValue input[name= " + input_name + " ]").addClass('input_with_validation_error');
                        $.each(err.e_values, function (key, value) {
                            $('#FormInsertBasicDataValue #error_msg_' + input_name).html(value.e_text);
                        });
                    });
                }
            },
            error: function (e) {
            }
        });
    } --}}
   var constraints = {
    /*       title: {
               presence: {message: '^<strong>عنوان الزامیست</strong>'}
           }*/
   };
   var form = document.querySelector("#FormInsertBasicDataValue");
   init_validatejs(form, constraints, showSuccessInsert,'#FormInsertBasicDataValue');

   function showSuccessInsert(formElement) {
       var formData = new FormData(formElement);
       $.ajax({
           type: "POST",
           url: '{{ route('backend.hotel_insert')}}',
           dataType: "json",
           data: formData,
           processData: false,
           contentType: false,
           success: function (data) {
               if (data.success == true) {
                   $("#FormInsertBasicDataValue .total_loader").remove();
                   $("#FormInsertBasicDataValue").find('input:text, input:password, input:file,textarea').val('');
                   $("#FormInsertBasicDataValue").find('select').val('0');


               }
               else {
                   $("#FormInsertBasicDataValue .total_loader").remove();
                   showMessages(data.message, 'message_basic_data_value_insert', 'error', formElement);
                   showErrors(form, data.errors);
               }
           }
       });
   }

</script>