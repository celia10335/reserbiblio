<?php
function fechaToString($fecha)
{
    $letras = explode("-", $fecha);

    switch ($letras[1]) {
        case "01":
            $letras[1] = 'Enero';
            break;
        case "02":
            $letras[1] = 'Febrero';
            break;
        case "03":
            $letras[1] = 'Marzo';
            break;
        case "04":
            $letras[1] = 'Abril';
            break;
        case "05":
            $letras[1] = 'Mayo';
            break;
        case "06":
            $letras[1] = 'Junio';
            break;
        case "07":
            $letras[1] = 'Julio';
            break;
        case "08":
            $letras[1] = 'Agosto';
            break;
        case "09":
            $letras[1] = 'Septiembre';
            break;
        case "10":
            $letras[1] = 'Octubre';
            break;
        case "11":
            $letras[1] = 'Noviembre';
            break;
        case "12":
            $letras[1] = 'Diciembre';
            break;
    }

    return $letras[2] . " de " . $letras[1] . " de " . $letras[0];
}
