(function(context) {

    if (context.adminList) {
        return;
    }

    context.adminList = {
        get_admin_list: function(page_no, list_max) {

            var type = 'free';
            var srch_kind = '';
            var srch_text = '';
            g_page_no = page_no;

            $.post("/ajax/ajax_get_news_list.php", {
                    'type': type,
                    'srch_kind': srch_kind,
                    'srch_text': srch_text,
                    'skip_no': ((page_no - 1) * list_max),
                    'list_max': list_max
                },
                function(data) {
                    if (data) {
                        $(".list_table > table").find("tr:gt(0)").detach();
                        adminList.set_admin_list(data);
                    }

                    if (data.length) {
                        var total_count = data[0]['total_count'];
                        paging.paging_warp(total_count, list_max, g_page_max, 'adminList.get_admin_list');
                    }
                }, 'json'
            );
        },
        set_admin_list: function(data) {

            if (!data.length) {
                $(".list_table > table").find("tr:eq(0)").after(function() {
                    var colspan = '6';
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

            $.each(data, function() {

                var item = '';

                item += '<tr>';
                item += '	<td><input type="checkbox" class="check_box" /></td>';
                item += '	<td class="title"><a href="/admin/board_view.php?type=' + this['type'] + '">' + this['nickname'] + '</a></td>';
                item += '	<td class="date">' + this['reg_date'] + '</td>';
                item += '	<td>' + this['published'] + '</td>';
                item += '	<td>' + this['content'] + '</td>';
                item += '	<td><button class="table_btn">Delete</button></td>';
                item += '</tr>';

                $(".list_table > table > tbody").append(item);
            });
        }
    }
})(window);

$(function() {
    adminList.get_admin_list('1', '15');
});
