(function(context) {

    if (context.admin) {
        return;
    }

    context.admin = {
        set_nav: function() {

            var path = news_type;

            $(".sub_menu a").each(function() {

                var href = $(this).attr('href');
                var href_slice = href.slice(27, 35);

                if (href_slice.indexOf(path) > -1) {
                    $(this).addClass('on');
                }
            });
        }
    }
})(window);

$(function() {
    admin.set_nav();
});
