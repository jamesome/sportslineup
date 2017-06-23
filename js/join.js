(function(context) {

    if (context.join) {
        return;
    }

    context.join = {
        set_year: function() {
            $("#set_month").datetimepicker({
                datepicker: false,
                format: 'H:i:s',
                step: 5 // min term
            });
        },
        join: function() {

        },
    }
})(window);
