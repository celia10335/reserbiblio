$(function () {
    window.onload = function () {

        alert("welcome");
        $(".horas").hide();

    };

    $(document).ready(function () {

        $(".aceptar").click(function (event) {


            //$(".horas").slideToggle();
            $(".horas").slideDown();
            //$(".boton").show("slow");
        });

    });
});