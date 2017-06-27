(function(context) {

    if (context.main) {
        return;
    }

    context.main = {
        get_main_news_list: function() {
            $.post("/ajax/ajax_get_main_news_list.php", {},
                function(data) {
                    if (data) {
                        main.set_main_news_list(data);
                    }
                }, 'json'
            );
        },
        set_main_news_list: function(data) {

            var parent = $(".main_news_tab");
            var data_key = []; // ie8 Object.keys(data);

            for (var key in data) {
                data_key.push(key);
            }

            // var link_arr = {
            //     'soccer': '/sports/soccer.php',
            //     'baseball': '/sports/baseball.php',
            //     'basketball': '/sports/basketball.php',
            //     'volleyball': '/sports/volleyball.php',
            //     'hockey': '/sports/hockey.php'
            // }
            var link_arr = {
                'free': '/community/freeboard.php',
                'best': '/community/best.php',
                'tournament': '/offline/tournament.php',
                'cafe': '/offline/boardcafe.php',
                'poker': '/community/poker.php',
                'photo': '/playground/photo.php'
            }

            for (var i = 0; i < data_key.length; i++) {

                var type = data_key[i];
                var news_main = parent.find(".news_" + type + " ul");
                var bdata = data[type];
                news_main.empty();

                for (var bi = 0; bi < bdata.length; bi++) {
                    var li_lists = '';

                    li_lists += '<li>';
                    li_lists += '	<a href="' + link_arr[type] + '">';
                    li_lists += '		<img src="/images/testimg.png" alt="" />';
                    li_lists += '		<div class="content">';
                    li_lists += '			<h3>' + bdata[bi]['subject'] + '</h3>';
                    li_lists += '			<p>' + bdata[bi]['nickname'] + '</p>';
                    li_lists += '			<div>';
                    li_lists += '				<strong class="c_red category">' + '' + '</strong>';
                    li_lists += '				<span class="bar"></span>';
                    li_lists += '				<span class="date">' + bdata[bi]['reg_date'] + '</span>';
                    li_lists += '			<div>';
                    li_lists += '		<div>';
                    li_lists += '	</a>';
                    li_lists += '</li>';

                    news_main.append(li_lists);
                }
            }
        }
    }
})(window);

$(function() {
    main.get_main_news_list();
});
