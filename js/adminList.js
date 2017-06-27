(function(context) {

    if (context.adminList) {
        return;
    }

    context.adminList = {
        get_admin_list: function() {
            var type = 'free';
            $.post("/ajax/ajax_get_news_list.php", {
                    'type': type
                    // 'srch_kind': srch_kind,
                    // 'srch_text': srch_text,
                    // 'skip_no': ((page_no - 1) * list_max),
                    // 'list_max': list_max
                },
                function(data) {
                    if (data) {
                        $(".admin_list > tbody").find("tr:gt(0)").detach();
                        adminList.set_admin_list(data);
                    }
                });
        },
        set_admin_list: function(data) {
            var data = JSON.parse(data)

            if (data.length) {
                $(".admin_list > table").find("tr:eq(0)").after(function() {
                    var colspan = '9';
                    if ($(this).find("th").length) {
                        colspan = $(this).find("th").length;
                    }
                    return $("<tr>").append($("<td>", {
                        'colspan': colspan,
                        'css': {
                            'text-align': 'center'
                        }
                    }).text('게시글이 없습니다.'))
                });

                return false;
            }
        }
    }
})(window);

$(function() {
    adminList.get_admin_list();
});
