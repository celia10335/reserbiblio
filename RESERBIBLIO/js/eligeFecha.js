$(function () {

    $("#datepicker").datepicker({
        dateFormat: "DD, d MM, yy",
        changeMonth: true,
        firstDay: 1,
        monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo",
            "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
        ],
        dayNames: ["domingo", "lunes", "martes", "miércoles", "jueves", "viernes", "sábado"],
        dayNamesShort: ["dom", "lun", "mar", "mié", "jue", "vie", "sáb"],
        dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
        prevText: "Ant",
        nextText: "Sig",
        currentText: "Hoy",
        autoSize: true,
        goToCurrent: true,
        minDate: "0d",
        maxDate: "+13d",
        hideIfNoPrevNext: false,
        beforeShowDay: $.datepicker.noWeekends,
        altField: "#fecha",
        altFormat: "DD, d MM yy"
    });

});
