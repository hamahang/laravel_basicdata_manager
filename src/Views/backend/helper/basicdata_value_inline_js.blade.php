<script src="{{asset('vendor/LBDM/js/select2.min.js')}}"></script>
<script>

   /* var datatable_basicdata_value;*/
    var columns=[
        {data: 'title', name: 'title', title: 'عنوان',width:'20%'},
        {data: 'dev_title', name: 'dev_title', title: 'عنوان مورد استفاده',width:'20%'} ,
        {data: 'comment', name: 'comment', title: 'توضیحات',width:'20%'},
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
                        '<span class="order_span">' + full.order + '</span>' +
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
                        '<span class="order_span">' + full.order + '</span>' +
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
            width:'12%',
            mRender: function (data, type, full) {
                return '<button type="button" class="btn btn-danger btn-sm btn-operation basicdata_value_delete  fa fa-times" data-id="' + full.id + '"></button>' + '' +
                    '<button type="button" class="btn btn-warning btn-sm btn-operation basicdata_value_edit fa fa-edit color-white" data-title="' + full.title + '" data-id="' + full.id + '" databasic-id=""></button>';
            }
        }
    ];
    var ajax_url='{{route('LBDM.GetBasicDataValue')}}';
    dataTablesGrid('#basicdata_value_table', 'datatable_basicdata_value', ajax_url, columns,{basicdata_id:{{$basic_id}}});
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
            $("#nav_tabs_value").append('<li class="nav-item" style="position: relative;" id="tab_edit_basic_value">' +
                '<a class="nav-link active show" data-toggle="tab" href="#edit_basicdata_value" > ' +
                '<span>ویرایش:</span><span id="span_title">' + $(this).attr('data-title') + '</span><span class="fa fa-times delete_tab_ico"></span>' +
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

   $(document).off('click', '.delete_tab_ico');
   $(document).on('click', '.delete_tab_ico', function () {
       $(this).parent().parent().remove();
       $("#tab_list_basicdata_value a").click();

   });

   var constraints = {
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
   var form = document.querySelector("#FormInsertBasicDataValue");
   init_validatejs(form, constraints, showSuccessInsert,'#FormInsertBasicDataValue');

   function showSuccessInsert(formElement) {
       var formData = new FormData(formElement);
       $.ajax({
           type: "POST",
           url: '{{ route('LBDM.InsertBasicDataValue')}}',
           dataType: "json",
           data: formData,
           processData: false,
           contentType: false,
           success: function (data) {
               if (data.success == true) {
                   $("#FormInsertBasicDataValue .total_loader").remove();
                   $("#FormInsertBasicDataValue").find('input:text, input:password, input:file,textarea').val('');
                   $("#FormInsertBasicDataValue").find('select').val('0');
                   datatable_basicdata_value.ajax.reload();
                   $("#tab_list_basicdata_value a").click();

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