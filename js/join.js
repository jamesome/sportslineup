(function(context) {

    if (context.join) {
        return;
    }

    context.join = {
        set_year: function() {
            $("#set_year").datepicker({
                dateFormat: "yy",
                changeYear: true,
                showButtonPanel: false,
                yearRange: 'c-100:c+100',
                onChangeMonthYear: function() {
                    $("#stdYear").datepicker("hide");
                },
                onClose: function(dateText, inst) {
                    var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                    $(this).datepicker("option", "defaultDate", new Date(year, 0, 1));
                    $(this).datepicker('setDate', new Date(year, 0, 1));
                    $("#stdYear").val(year);
                }
            });
        },
        join: function() {

        },
    }
})(window);

$(function() {
    join.set_year();
});
