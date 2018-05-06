    function init_select2(selector,url,allowClear,multiple,tags,placeholder) {
        allowClear = allowClear || false;
        tags = tags || false;
        multiple = multiple || false;
        placeholder = placeholder || "جستجو کنید ...";
        url = url
        $(selector).select2({
            minimumInputLength: 3,
            allowClear: allowClear,
            multiple: multiple,
            tags:tags,
            dir: "rtl",
            width: "100%",
            placeholder: placeholder,
            language: "fa",
            tags: false,
            ajax: {
                url: url,
                dataType: "json",
                type: "POST",
                quietMillis: 150,
                data: function (term) {
                    return {
                        term: term
                    };
                },
                results: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.text,
                                id: item.id
                            }
                        })
                    };
                }
            }
        });
    }
