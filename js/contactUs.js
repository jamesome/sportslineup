(function(context) {

    if (context.contactUs) {
        return;
    }

    context.contactUs = {
        set_content: function() {
            $("#contact_us").off('click');

            var contact_name = $('#contact_name').val().trim();
            var contact_email = $('#contact_email').val().trim();
            var contact_con = $('#contact_con').val().trim();
            var retn = true;

            if (retn && contact_name == '') {
                common.commmon_alert('Oops..!', 'Please Check your NAME', 'warning');
                retn = false;
            }
            if (retn && contact_email == '') {
                common.commmon_alert('Oops..!', 'Please Check your EMAIL', 'warning');
                retn = false;
            }
            if (retn && contact_con == '') {
                common.commmon_alert('Oops..!', 'Please Check your COMMENT', 'warning');
                retn = false;
            }

            if (!retn) {
                $("#contact_us").on('click', contactUs.set_content);
                return false;
            }

            $.post("/ajax/ajax_set_contentUs.php", {
                    'contact_name': contact_name,
                    'contact_email': contact_email,
                    'contact_con': contact_con
                },
                function(data) {
                    if (data == '1') {
                        common.commmon_alert('Thank You', 'for your comment', 'success');
                    } else {
                        common.commmon_alert('Oops..!', '', 'error');
                    }
                });
        }
    }
})(window);

$(function() {
    $('#contact_us').click(function() {
        contactUs.set_content();
    })
});
