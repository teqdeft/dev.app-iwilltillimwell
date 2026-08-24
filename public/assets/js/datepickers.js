let date = new Date(moment.now());
let today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
let tomorrow = new Date(+date + 86400000);
let pickerOptsGeneral = {
    uiLibrary: 'bootstrap4',
    /*  format: "yyyy-mm-dd", */
    date: getDateInFormat(today),
    autoclose: true,
    minView: 2,
    maxView: 2,
    todayHighlight: true,
    templates: {
        leftArrow: '<i class="fa fa-chevron-left"></i>',
        rightArrow: '<i class="fa fa-chevron-right"></i>',
    },
    icons: {
        time: "fa fa-clock-o",
        date: "fa fa-calendar",
        up: "fa fa-arrow-up",
        down: "fa fa-arrow-down",
        previous: "fa fa-chevron-left",
        next: "fa fa-chevron-right",
        today: "fa fa-clock-o",
        clear: "fa fa-trash-o"
    },
};

function getDateInFormat(date = null) {
    if (date) {
        return date.getFullYear() + '-' + ('0' + (date.getMonth() + 1)).slice(-2) + '-' + ('0' + date.getDate()).slice(-2);
    }
}

$(document).ready(function() {
    $('#date_of_birth').datepicker(Object.assign({}, pickerOptsGeneral, {
        changeMonth: true,
        changeYear: true,
        endDate: new Date()
    }));

    $('.date-icon').on('click', function() {
        $('.datePickerMonthYear').focus();
    });

    $(".datePickerMonthYear").datepicker(Object.assign({}, pickerOptsGeneral,{
        changeMonth: true,
        changeYear: true,
        yearRange: "-90:+0",
        maxDate: new Date()
    }));


    $('.dependent_dob').datepicker(pickerOptsGeneral).on('changeDate', function(ev) {
        let dob = new Date(ev.date);
        let today = new Date();
        let age = Math.floor((today - dob) / (365.25 * 24 * 60 * 60 * 1000));
        if (age > 18) {
            $(".dependent-email-cnt").show();
        } else {
            $(".dependent-email-cnt").hide();
        }
    });
    $('#schedule-consultation').datepicker(Object.assign({}, pickerOptsGeneral, {
        show: true,
        startDate: new Date()
    }));
    $('#schedule-consultation').on('changeDate', function(ev) {
        let selected_date = new Date(ev.date);
        $(".scheduled-date").text(moment(selected_date).format('MM/DD/YYYY'));
        $(".cal-selected-date").val(moment(selected_date).format('YYYY-MM-DD'));
    });
    let scheduled_date = moment(date).format('MM/DD/YYYY');
    $(".scheduled-date").text(scheduled_date);
    $(".cal-selected-date").val(moment(date).format('YYYY-MM-DD'));

   /*  $('.date-icon').on('click', function() {
        $('#date_of_birth').focus();
    }); */

    $('.from-date-icon').on('click', function() {
        $('#valid_from').focus();
    });

    $('.to-date-icon').on('click', function() {
        $('#valid_to').focus();
    });

    $('#valid_from').datepicker(Object.assign({}, pickerOptsGeneral, {
        format: "yyyy-mm-dd"
    })).on('changeDate', function(ev) {
        endDate = new Date(ev.date);
        $('#valid_to').datepicker('setStartDate', endDate);
    });
    $('#valid_to').datepicker(Object.assign({}, pickerOptsGeneral, {
        format: "yyyy-mm-dd"
    }));

    $('#commission_from').datepicker(Object.assign({}, pickerOptsGeneral, {
        format: "yyyy-mm-dd"
    })).on('changeDate', function(ev) {
        endDate = new Date(ev.date);
        $('#commission_to').datepicker('setStartDate', endDate);
    });
    $('#commission_to').datepicker(Object.assign({}, pickerOptsGeneral, {
        format: "yyyy-mm-dd"
    }));
    $('.conference_day').datepicker(Object.assign({}, pickerOptsGeneral, {
        format: "yyyy-mm-dd"
    }));


    $('.conferene_start_time_mk').mdtimepicker({
        timeFormat: 'hh:mm', // format of the time value (data-time attribute)
        format: 'h:mm tt', // format of the input value
        is24Hour: false,
        readOnly: true, // determines if input is readonly
        hourPadding: false,
        theme: 'green',
        okLabel: 'Ok',
        cancelLabel: 'Cancel',
    });

    $('.conferene_end_time_mk').mdtimepicker({
        timeFormat: 'hh:mm', // format of the time value (data-time attribute)
        format: 'h:mm tt', // format of the input value
        is24Hour: false,
        readOnly: true, // determines if input is readonly
        hourPadding: false,
        theme: 'green',
        okLabel: 'Ok',
        cancelLabel: 'Cancel',
    });


    $('.commission-from-date-icon').on('click', function() {
        $('#commission_from').focus();
    });

    $('.commission-to-date-icon').on('click', function() {
        $('#commission_to').focus();
    });

    $('.last_registration_date').datepicker(Object.assign({}, pickerOptsGeneral, {
        format: "yyyy-mm-dd"
    }));




});
