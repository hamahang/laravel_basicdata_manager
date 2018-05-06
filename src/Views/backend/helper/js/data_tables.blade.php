<script>
    var LangJson_DataTables={
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
    $.extend($.fn.dataTable.defaults, {
        autoWidth: false,
        dom: CommonDom_DataTables,
        language: LangJson_DataTables,
        processing: true,
        serverSide: true,
        drawCallback: function () {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
        },
        preDrawCallback: function () {
            $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
        }
    });

    function dataTablesGrid(selector, var_grid_name, url, columns, more_data, initComplete, scrollX) {
        scrollX = scrollX || false;
        more_data = more_data || {};
        window[var_grid_name] = $(selector).DataTable({
            initComplete: function () {
                if (initComplete == true) {
                    this.api().columns().every(function () {
                        var column = this;
                        var select = $('<select class="filter-select" data-placeholder="Filter"><option value=""></option></select>')
                            .appendTo($(column.footer()).not(':last-child').empty())
                            .on('change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );
                                column
                                    .search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                            });
                        column.data().unique().sort().each(function (d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>')
                        });
                    });
                }
            },
            ajax: {
                url: url,
                type: 'POST',
                data: more_data
            },
            columns: columns,
            scrollX: scrollX
        });
    }

</script>