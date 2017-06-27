(function(context) {

    if (context.signIn) {
        return;
    }

    context.signIn = {
        login: function() {
            $("#login").off('click');

            var login_id = $('#login_id').val();
            var login_pw = $('#login_pw').val();
            var retn = true;

            if (retn && login_id == '') {
                common.commmon_alert('Please Enter your ID', '', 'warning');
                retn = false;
            }
            if (retn && login_pw == '') {
                common.commmon_alert('Please Enter your PW', '', 'warning');
                retn = false;
            }

            if (!retn) {
                $("#login").on('click', signIn.login);
                return false;
            }

            // if (retn) {
            //     common.commmon_alert('Oops..!', 'You can not Login', 'error');
            //     return false;
            // }

            $.post("/ajax/ajax_set_login.php", {
                    'userid': login_id,
                    'userpw': login_pw
                },
                function(data) {
                    if (data == 'ok') {
                        swal({
                            title: 'Signed in',
                            text: '',
                            type: 'success'
                        }).then(
                            function() {
                                top.location.replace("/");
                            }
                        )
                    } else if (data == 'uid') {
                        common.commmon_alert('Please Check your ID', '', 'info');
                    } else if (data == 'upass') {
                        common.commmon_alert('PASSWORD ERROR', 'Please Check your PW', 'info');
                    }
                });
        },
        logout: function() {

            $.post("/ajax/ajax_set_logout.php", {
                    'mode': 'logout'
                },
                function(data) {
                    if (data == 'ok') {
                        top.location.replace("/");
                    }
                }
            );
        }
    };
})(window);

$(function() {
    $('#login').click(function() {
        signIn.login();
    });

    $("#logout").click(function() {
        signIn.logout();
    });

    $("#login_pw").keyup(function(e) {
        if (e.keyCode == 13 || e.charCode == 13) {
            $("#login").click();
        }
    });
});
