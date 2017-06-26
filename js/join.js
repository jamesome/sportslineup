(function(context) {

    if (context.join) {
        return;
    }

    context.join = {
        set_year: function() {
            $('#set_year').datepicker({
                changeYear: true,
                showButtonPanel: true,
                dateFormat: 'yy',
                onClose: function(dateText, inst) {
                    var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                    $(this).datepicker('setDate', new Date(year, 1, 1));
                }
            });
        },
        set_month: function() {
            $('#set_month').datepicker({
                changeMonth: true,
                showButtonPanel: true,
                dateFormat: 'MM',
                onClose: function(dateText, inst) {
                    var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                    $(this).datepicker('setDate', new Date(month, 1));
                }
            });
        },
        join: function() {

        },
    }
})(window);

$(function() {
    join.set_year();
    join.set_month();
});
