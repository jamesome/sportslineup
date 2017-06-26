(function(context) {

    if (context.sign_in) {
        return;
    }

    context.sign_in = {
        login: function() {
            var login_id = $('#login_id').val();
            var login_pw = $('#login_pw').val();

            console.log(login_id, login_pw)
        },
        a: function() {
            console.log(1);
        }
    };
})(window);

$(function() {
    $('#sign_up').click(function() {
        alert('a');
    });
    sign_in.a();
});
