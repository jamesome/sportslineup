(function(context) {

    if (context.signUp) {
        return;
    }

    context.signUp = {
        join: function() {
            var join_id = $('#join_id').val();
            var join_pass1 = $('#join_pass1').val();
            var join_pass2 = $('#join_pass2').val();
            var join_mobile = $('.join_mobile').val();
            var verification_code = $('.verification_code').val();
            var set_month = $('#set_month').val();
            var set_year = $('#set_year').val();
            var join_fnc = $('#join_fnc').val();
            var join_lnc = $('#join_lnc').val();
            var retn = true;

            if (retn && join_id == '') {
                common.commmon_alert('Please Check your ID', '', 'error');
                retn = false;
            }
            if (retn && join_pass1 == '') {
                common.commmon_alert('Please Check your PW', '', 'error');
                retn = false;
            }
            if (retn && join_pass2 == '') {
                common.commmon_alert('Please Check your PW', '', 'error');
                retn = false;
            }
            if (retn && join_pass1 != join_pass2) {
                common.commmon_alert('Passwords are different', '', 'error');
                retn = false;
            }
            if (retn && join_mobile == '') {
                common.commmon_alert('Please Check your Mobile_number', '', 'error');
                retn = false;
            }
            if (retn && verification_code == '') {
                common.commmon_alert('Please Check verification_code', '', 'error');
                retn = false;
            }
            if (retn && set_month == '') {
                common.commmon_alert('Please Check Explration Date', '', 'error');
                retn = false;
            }
            if (retn && set_year == '') {
                common.commmon_alert('Please Check Explration Date', '', 'error');
                retn = false;
            }
            if (retn && join_fnc == '') {
                common.commmon_alert('Please Check your First Name', '', 'error');
                retn = false;
            }
            if (retn && join_lnc == '') {
                common.commmon_alert('Please Check your Last Name', '', 'error');
                retn = false;
            }

            if (!retn) {
                $("#sign_up").on('click', sign_up.join);
                return false;
            }

            $.post("/ajax/ajax_set_join.php", {
                    'join_id': join_id,
                    'join_pw': join_pass1,
                    'join_mobile': join_mobile,
                    'verification_code': verification_code,
                    'set_year': set_year,
                    'set_month': set_month,
                    'join_fnc': join_fnc,
                    'join_lnc': join_lnc
                },
                function(data) {
                    if (data == 'ok') {
                        common.commmon_alert('Signed up', '', 'success');
                    } else if (data == 'uid') {
                        common.commmon_alert('Please Check your ID', '', 'info');
                    } else if (data == 'upass') {
                        common.commmon_alert('Please Check your PW', '', 'info');
                    }
                });

            console.log(join_id);
        },
        test:function(){
            alert('dd');
        }
    };
})(window);
