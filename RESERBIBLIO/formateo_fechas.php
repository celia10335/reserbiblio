<?php
function formateoFechas($stringFecha)
{
    $letras = explode(" ", $stringFecha);

    switch ($letras[2]) {
        case "Enero":
            $letras[2] = '01';
            break;
        case "Febrero":
            $letras[2] = '02';
            break;
        case "Marzo":
            $letras[2] = '03';
            break;
        case "Abril":
            $letras[2] = '04';
            break;
        case "Mayo":
            $letras[2] = '05';
            break;
        case "Junio":
            $letras[2] = '06';
            break;
        case "Julio":
            $letras[2] = '07';
            break;
        case "Agosto":
            $letras[2] = '08';
            break;
        case "Septiembre":
            $letras[2] = '09';
            break;
        case "Octubre":
            $letras[2] = '10';
            break;
        case "Noviembre":
            $letras[2] = '11';
            break;
        case "Diciembre":
            $letras[2] = '12';
            break;
    }

    if ($letras[1] < 10) {

        $fechaForm = $letras[3] . "-" . $letras[2] . "-0" . $letras[1];
    } else {


        $fechaForm = $letras[3] . "-" . $letras[2] . "-" . $letras[1];
    }

    return $fechaForm;
}
