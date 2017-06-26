(function(context) {

    if (context.sign_in) {
        return;
    }

    context.sign_in = {
        login: function() {
            var login_id = $('#login_id').val();
            var login_pw = $('#login_pw').val();
            var retn = true;

            if (retn && login_id == '') {
                common.commmon_alert('Please Enter your ID', '', 'error');
                retn = false;
            }
            if (retn && login_pw == '') {
                common.commmon_alert('Please Enter your PW', '', 'error');
                retn = false;
            }

            if (!retn) {
                $("#login").on('click', sign_in.login);
                return false;
            }

            $.post("/ajax/ajax_set_login.php", {
                    'userid': login_id,
                    'userpw': login_pw
                },
                function(data) {
                    if (data == 'ok') {
                        common.commmon_alert('Signed in', '', 'success');
                    } else if (data == 'uid') {
                        common.commmon_alert('Please Check your ID', '', 'info');
                    } else if (data == 'upass') {
                        common.commmon_alert('Please Check your PW', '', 'info');
                    }
                });
        }

    };
})(window);

$(function() {
    $('#login').click(function() {
        sign_in.login();
    });
});
