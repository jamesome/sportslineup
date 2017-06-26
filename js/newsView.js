(function(context) {
    if (context.newsView) {
        return;
    }

    context.newsView = {
        get_news_view: function(b_idx) {

            $.post("/ajax/ajax_get_news_view.php", {
                    'board_idx': ''
                },
                function(data) {
                    if (data) {
                        $(".board_view .view").detach();
                        newsView.set_news_view(data);
                    }
                }, 'json'
            );
        },
        set_news_view: function(data) {
            if (data['is_delete'] == 'Y') {
                common.commmon_alert('Deleted', '', 'info');
            }

            var item = '';

            item += '<div id="main_con" class="view">';
            item += '	<div class="view_top">';
            item += '		<h2>' + data + '</h2>';
            item += '		<p>' + data + '</p>';
            item += '	</div>';
            item += '	<div class="view_content">';
            item += '		<div class="con_img">';
            item += '			<img src="/images/main_news.png" alt="" />';
            item += '		</div>';
            item += '		<div class="con_txt">' + data + '</div>';
            item += '	</div>';
            item += '	<p class="writer">' + data + '<span class="c_red">' + data + '</span></p>';
            item += '</div>';

            $(".board_view").append(item);
        }

    };
})(window);

$(function() {
    newsView.get_news_view();
});
