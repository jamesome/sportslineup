(function(context) {

    if (context.paging) {
        return;
    }

    context.paging = {
        /*
         * 페이징
         */
        paging_warp: function(count, list_max, page_max, fn, add_param) {

            var board_page = $(".paging");

            var first_page, last_page;
            var start_page, end_page, now_block;
            var prev_page, prev1_page, next_page, next1_page;

            if (!count) {
                board_page.empty();
                return false;
            }
            if (g_page_no == null || g_page_no == undefined) return false;
            if (add_param == null || add_param == undefined) {
                add_param = '';
            } else {
                add_param = ', ' + add_param;
            }

            var get_linkpage_tag = function(page, text, on) {
                var tag = '';
                var onclick = '';
                if (page > 0) {
                    onclick = ' onclick="' + fn + '(\'' + page + '\', \'' + list_max + '\'' + add_param + ')"';
                }
                if (text == 'prev2') {
                    tag = '<a class="prev2"' + onclick + '><img src="/images/admin/prev2.png" alt="" /></a>';
                } else if (text == 'prev1') {
                    tag = '<a class="prev1"' + onclick + '><img src="/images/admin/prev1.png" alt="" /></a>';
                } else if (text == 'next2') {
                    tag = '<a class="next2"' + onclick + '><img src="/images/admin/next2.png" alt="" /></a>';
                } else if (text == 'next1') {
                    tag = '<a class="next1"' + onclick + '><img src="/images/admin/next1.png" alt="" /></a>';
                } else {
                    on = (on == '' || on == '0') ? false : true;
                    tag = '<a class="btn_page' + ((on) ? ' on' : '') + '"' + onclick + '>' + text + '</a>';
                }

                return tag;
            };

            g_page_no = g_page_no ? parseInt(g_page_no) : 1;

            var page_count = Math.ceil(count / list_max);
            first_page = 1;
            last_page = page_count;
            /*

            // simple paging
            now_block = Math.ceil(g_page_no / page_max);
            start_page = (now_block - 1)*page_max + 1;
            end_page = (now_block * page_max > last_page) ? last_page : (now_block * page_max);
            */

            // variable paging
            now_block = Math.floor(page_max / 2); // half
            start_page = ((g_page_no - now_block) < first_page) ? first_page : (g_page_no - now_block);
            end_page = ((g_page_no + now_block + (now_block % 2 > 0 ? 1 : 0)) > last_page) ? last_page : (g_page_no + now_block + (now_block % 2 > 0 ? 1 : 0));
            var block_max = end_page - start_page + 1;
            if (block_max < page_max) {
                if (start_page > first_page && end_page == last_page) {
                    start_page = ((end_page - page_max + 1) < first_page) ? first_page : (end_page - page_max + 1);
                } else if (start_page > first_page) {
                    start_page = ((start_page - block_max - 1) < first_page) ? first_page : (start_page - block_max - 1);
                }
            }
            block_max = end_page - start_page + 1;
            if (block_max < page_max) {
                if (end_page < last_page && start_page == first_page) {
                    end_page = ((first_page + page_max - 1) > last_page) ? last_page : (first_page + page_max - 1);
                } else if (end_page < last_page) {
                    end_page = ((end_page + block_max - 1) > last_page) ? last_page : (end_page + block_max - 1);
                }
            }

            prev_page = ((g_page_no - 1) < first_page) ? first_page : (g_page_no - 1);
            prev1_page = ((start_page - 1) < first_page) ? first_page : (start_page - 1);
            next_page = ((g_page_no + 1) > last_page) ? last_page : (g_page_no + 1);
            next1_page = ((end_page + 1) > last_page) ? last_page : (end_page + 1);

            var table = go_page = '';
            // prev2
            if (g_page_no > first_page) {
                go_page = first_page;
            }
            table += get_linkpage_tag(go_page, 'prev2', '');

            // prev1
            go_page = '';
            if (g_page_no > prev1_page) {
                go_page = prev1_page;
            }
            table += get_linkpage_tag(go_page, 'prev1', '');

            // Num page
            for (var i = start_page; i <= end_page; i++) {
                if (g_page_no == i) {
                    table += get_linkpage_tag(i, i, 'on');
                } else {
                    table += get_linkpage_tag(i, i, '');
                }
            }

            // next1
            go_page = '';
            if (g_page_no < next1_page) {
                go_page = next1_page;
            }
            table += get_linkpage_tag(go_page, 'next1', '');

            // next2
            go_page = '';
            if (g_page_no < last_page) {
                go_page = last_page;
            }
            table += get_linkpage_tag(last_page, 'next2', '');

            board_page.html(table);

            // if (window.location.pathname.indexOf('/admin/') > -1) { // 관리자화면시 좌측메뉴 hieght back
            // 	admin_h();
            // }
        }
    };
})(window);
