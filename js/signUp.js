(function(context) {

    if (context.signUp) {
        return;
    }

    context.signUp = {
        join: function() {
            var join_id = $('#join_id').val().trim();
            var join_pass1 = $('#join_pass1').val().trim();
            var join_pass2 = $('#join_pass2').val().trim();
            var join_mobile = $('.join_mobile').val().trim();
            var verification_code = $('.verification_code').val().trim();
            var set_month = $('#set_month').val().trim();
            var set_year = $('#set_year').val().trim();
            var join_fnc = $('#join_fnc').val().trim();
            var join_lnc = $('#join_lnc').val().trim();
            var retn = true;

            if (retn && join_id == '') {
                common.commmon_alert('Oops..!', 'Please Check your ID', 'warning');
                retn = false;
            }
            if (retn && join_pass1 == '') {
                common.commmon_alert('Oops..!', 'Please Check your PW', 'warning');
                retn = false;
            }
            if (retn && join_pass2 == '') {
                common.commmon_alert('Oops..!', 'Please Check your PW', 'warning');
                retn = false;
            }
            if (retn && join_pass1 != join_pass2) {
                common.commmon_alert('Oops..!', 'Passwords are different', 'warning');
                retn = false;
            }
            if (retn && join_mobile == '') {
                common.commmon_alert('Oops..!', 'Please Check your Mobile_number', 'warning');
                retn = false;
            }
            if (retn && verification_code == '') {
                common.commmon_alert('Oops..!', 'Please Check verification_code', 'warning');
                retn = false;
            }
            if (retn && set_month == '') {
                common.commmon_alert('Oops..!', 'Please Check Explration Date', 'warning');
                retn = false;
            }
            if (retn && set_year == '') {
                common.commmon_alert('Oops..!', 'Please Check Explration Date', 'warning');
                retn = false;
            }
            if (retn && join_fnc == '') {
                common.commmon_alert('Oops..!', 'Please Check your First Name', 'warning');
                retn = false;
            }
            if (retn && join_lnc == '') {
                common.commmon_alert('Oops..!', 'Please Check your Last Name', 'warning');
                retn = false;
            }

            if (!retn) {
                $("#sign_up").on('click', signUp.join);
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
                        common.commmon_alert('Please Check your ID', '', 'warning');
                    } else if (data == 'upass') {
                        common.commmon_alert('Please Check your PW', '', 'warning');
                    }
                });
        },
        id_check: function() {
            var join_id = $('#join_id').val().trim();
            var msg = '';

            if (/[^0-9a-zA-Z]/.test(join_id)) {
                //"특수문자는 넣을 수 없습니다."
                msg = 'Spaces and other special characters are not allowed.';
                return common.commmon_alert('Oops..!', msg, 'warning');
            } else if (join_id.bytes() > 10 || join_id.bytes() < 6) {
                //"숫자/영문조합 4~10자리까지 가능합니다."
                msg = 'Please enter at least six characters.';
                sub_msg = 'maximum of ten characters';
                return common.commmon_alert(msg, sub_msg, 'warning');
            } else {
                msg = ' This ID is available.';
                return common.commmon_alert('Good job!', msg, 'success');
            }
            // else {
            //     $.post("/ajax/ajax_get_join_id_check.php", {
            //             'join_id': join_id
            //         },
            //         function(data) {
            //             if (data == 'ok') {
            //                 $('.join_id_notice_ok').show();
            //                 $('.join_id_notice_no1').hide();
            //                 $('.join_id_notice_no2').hide();
            //             } else {
            //                 $('.join_id_notice_no1').show();
            //                 $('.join_id_notice_no2').hide();
            //                 $('.join_id_notice_ok').hide();
            //             }
            //             $(".join_id").blur(get_join_id_check);
            //         });
            // }

            return msg;
        },
        pw_check: function() {
            var join_pw = $('#join_pass1').val().trim();
            var chk_num = join_pw.search(/[0-9]/g);
            var chk_eng = join_pw.search(/[a-z]/ig);
            var msg = '';

            if (!/^[a-zA-Z0-9\~\∙\!\@\#\$\%\^\&\*\(\)\_\-\+\=\{\}\[\]\|\\\;\:‘\“\<\>\,\.\?\/]{6,10}$/.test(join_pw)) {
                //"비밀번호는 6~10자리를 사용해야 합니다."
                msg = 'Please enter at least six characters.\n(maximum of ten characters)';
                return common.commmon_alert('Oops..!', msg, 'warning');
            } else if (chk_num < 0 || chk_eng < 0) {
                //"비밀번호는 숫자와 영문자를 혼용하여야 합니다."
                msg = 'The password must be a combination of letters and numbers.';
                return common.commmon_alert('Oops..!', msg, 'warning');
            } else if (/(\w)\1\1\1/.test(join_pw)) {
                //"비밀번호에 같은 문자를 4번 이상 사용하실 수 없습니다."
                msg = 'You can not use the same character more than 4 times in your password.';
                return common.commmon_alert('Oops..!', msg, 'warning');
            } else {
                msg = ' This PW is available.';
                return common.commmon_alert('Good job!', msg, 'success');
            }
        }
    };
})(window);

$(function() {
    $('#sign_up').click(function() {
        signUp.join();
    });

    $('#join_id').blur(function() {
        signUp.id_check();
    });

    $('#join_pass1').blur(function() {
        signUp.pw_check();
    });
});
