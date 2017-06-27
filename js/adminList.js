(function(context) {

    if (context.adminList) {
        return;
    }

    context.adminList = {
        get_admin_list: function(page_no, list_max) {
            var srch_kind = '';
            var srch_text = '';
            g_page_no = page_no;

            $.post("/ajax/ajax_get_news_list.php", {
                    'type': news_type,
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
                item += '   <td><input type="checkbox" name="subCheck" class="case chkb" value="' + this['idx'] + '" click="function(){check_Sel();}" /></td>';
                item += '	<td class="title"><a href="/admin/board_view.php?type=' + this['type'] + '?page_no=' + g_page_no + '">' + this['nickname'] + '</a></td>';
                item += '	<td class="date">' + this['reg_date'] + '</td>';
                item += '	<td>' + this['published'] + '</td>';
                item += '	<td>' + this['content'] + '</td>';
                item += '	<td><button class="table_btn">Delete</button></td>';
                item += '</tr>';

                $(".list_table > table > tbody").append(item);
            });
        },
        checkBox: function() {
            // 만약 checkedAll 이 'checked'되어 있다면
            if ($('.selectall').prop('checked')) {
                // checkbox 타입의 input 중 name이 subCheck 인 것들의 checked의 prop 값을 true로 변경
                $('input[name=subCheck]:checkbox').each(function() {
                    $(this).prop('checked', true);
                });
                // selectall 이 checked 되어 있지 않다면
            } else {
                // checkbox 타입의 input 중 name이 subCheck 인 것들의 checked의 prop 값을 false로 변경
                $('input[name=subCheck]:checkbox').each(function() {
                    $(this).prop('checked', false);
                });
            }
        },
        check_Sel: function() {
            var len = $('input[type="checkbox"]').filter(".chkb").length;

            for (i = 0; i < len; i++) {
                if ($('input[type="checkbox"]').filter(".chkb")[i].checked == false) {
                    $('input[type="checkbox"]').filter(".selectall").prop("checked", false);
                    return true;
                }
            }
            $('input[type="checkbox"]').filter(".selectall").prop("checked", true);
            return true;
        },
        set_news_delete: function() {
            var idx = '';
            $("input[type='checkbox']").filter(".chkb").each(function(i, val) {
                if ($(this).is(":checked")) {
                    idx += '|' + $(this).val();
                }
            });

            if (!idx) {
                common.commmon_alert('Oops..!', 'To delete a checkBox, select one.', 'warning');
                return false;
            }
        }
    }
})(window);

$(function() {
    adminList.get_admin_list('1', '15');
    $('.btn_delete').click(function() {
        adminList.set_news_delete();
    });
});
