(function(context) {

    if (context.main) {
        return;
    }

    context.main = {
        get_main_news_list: function() {
            $.post("/ajax/ajax_get_main_news_list.php", {},
                function(data) {
                    if (data) {
                        //$(".news_tab_con ul").detach();
                        main.set_main_news_list(data);
                    }
                });
        },
        set_main_news_list: function(data) {
			console.log(data)
            var $parent = $(".news_tab_con");
            var data_key = []; // ie8 Object.keys(data);
            var $li_lists = '';
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

            // for (var i = 0; i < data_key.length; i++) {
			//
            //     var type = data_key[i];
            //     var $board_main = $parent.find(type);
            //     var bdata = data[type];
            //     $board_main.empty();
			//
            //     for (var bi = 0; bi < bdata.length; bi++) {
            //         $li_lists += '<li>';
            //         $li_lists += '	<a href="sub/view.php">';
            //         $li_lists += '		<img src="/images/testimg.png" alt="" />';
            //         $li_lists += '		<div class="content">';
            //         $li_lists += '			<h3>' + bdata[bi]['subject'] + '</h3>';
            //         $li_lists += '			<p>' + bdata[bi]['content'] + '</p>';
            //         $li_lists += '			<div>';
            //         $li_lists += '				<strong class="c_red category">' + link_arr['type'] + '</strong>';
            //         $li_lists += '				<span class="bar"></span>';
            //         $li_lists += '				<span class="date">' + bdata[bi]['reg_date'] + '</span>';
            //         $li_lists += '			<div>';
            //         $li_lists += '		<div>';
            //         $li_lists += '	</a>';
            //         $li_lists += '</li>';
			//
            //         $board_main.append($li_lists);
            //     }
            // }
        }
    }
})(window);

$(function() {
    main.get_main_news_list();
});
