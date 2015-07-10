$(document).ready(function () {
    $('.date').datetimepicker({
        format: 'DD/MM/YYYY',
        pickTime: false
    });

    $('.picktime').datetimepicker({
        format: 'LT',
        pickDate: false
    });
});


