<div id="div_insert">
    <button class="btn btn-success btn-lg" id="btn_insert_basicdata_value" type="button">ثبت</button>
</div>
<div id="div_update">
    <button class="btn btn-warning btn-lg" id="btn_update_basicdata_value" type="button">ویرایش</button>
</div>
<button class="btn btn-default btn-lg" id="btn_close_basicdata_value" type="button">بستن</button>
<script>
    $("#div_insert").hide();
    $("#div_update").hide();
    $('#btn_insert_basicdata_value').off();
    $('#btn_insert_basicdata_value').on('click',function () {
        $("#submit_insert_basicdata_value").click();
    });
    $('#btn_update_basicdata_value').off();
    $('#btn_update_basicdata_value').on('click',function () {
        $("#submit_update_basicdata_value").click();
    });
    $('#btn_close_basicdata_value').off();
    $('#btn_close_basicdata_value').on('click',function () {
        $(".jsglyph-close").click();
    });
    $('#tab_list_basicdata_value').off();
    $("#tab_list_basicdata_value").on('click',function(){
        $("#div_insert").hide();
        $("#div_update").hide();
    });

    $('#tab_new_basicdata_value a').off();
    $("#tab_new_basicdata_value a").on('click',function(){
        $("#div_insert").show();
        $("#div_update").hide();
    });

    $(document).off('click','#tab_edit_basic_value');
    $(document).on('click','#tab_edit_basic_value',function(){
        $("#div_insert").hide();
        $("#div_update").show();
    });

</script>