$(document).on("click", ".jsPanels", function () {
    link = $(this).attr('href');
    title = $(this).attr('title');
    modal = 'modal' == $(this).attr('modal') ? 'modal' : '';
    get_height = $(this).attr('height');
    /* if (link.indexOf('share?sid') > 0)
     title = 'بازنشر';
     if (link.indexOf('print?sid') > 0)
     title = 'چاپ';*/
    var h = $(window).height();
    var w = $(window).width();

    w = w - 800;
    w = w / 2;

    h = h - 530;
    h = h / 2;

    /* if (get_height != '')
     hei = '500';
     else
     hei = 'auto';*/

    var JS_Panel = $.jsPanel({
        contentAjax: {
            url: link,
            method: 'POST',
            dataType: 'json',
            done: function (data, textStatus, jqXHR, panel) {
                //  this.content.append(jqXHR.responseText);
                console.log(data.content);
                panel.headerTitle(data.header);
                panel.content.html(data.content);
                panel.toolbarAdd('footer', [{item: data.footer}]);
                // panel.content.css({"width": "800px", "max-height": "550px", "height": hei, 'overflow-y': 'auto'});
            }
        },
        rtl: {
            rtl:  true,
            lang: 'he'
        },
        headerControls: {
            minimize: 'disable',
            smallify: 'disable'
        },
        headerTitle: '',
        contentOverflow: {horizontal: 'hidden', vertical: 'auto'},
        //  panelSize: {width: w * 0.7, height: h * 0.7},
        contentSize: {width: "800px", height: "500px"},
        position:    {my: "center-top", at: "center-top", offsetY: 15},

        theme:  "info",
        paneltype: modal,
    });
    JS_Panel.resize('1000px','600px');
    JS_Panel.content.html('<div class="myloader"><img src="{{URL(assets/images/Loading_icon.gif)}}">لطفا منتظر بمانید</div>');
    return false;
});
