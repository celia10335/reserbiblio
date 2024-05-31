<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Título -->
    <title>Añadir franjas de reserva</title>

    <!-- Fav icon-->
    <link rel="icon" type="image/x-icon" href="../img/logo-sin_fondo.png">

    <!-- Fuentes de Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Expletus+Sans:ital,wght@0,400..700;1,400..700&family=Gayathri:wght@100;400;700&family=KoHo:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />


    <!-- Iconos Font Awesome -->
    <script src="https://kit.fontawesome.com/442e6a0d83.js" crossorigin="anonymous"></script>
    <!-- Hojas de estilo -->
    <link rel="stylesheet" href="estilos_gestion/estiloGestion.css" />
</head>

<body>

    <?php
    require_once '../config/config.php';
    require_once '../modelo/asientoModel.php';
    require_once '../modelo/bibliotecaModel.php';
    require_once '../modelo/franjaModel.php';
    require_once '../modelo/dbModel.php';
    require_once '../controlador/bibliotecaControl.php';


    $conectado;

    function conectar(&$conectado)
    {
        $objetoDb = new Db;
        $conectado = $objetoDb->conection;
    }

    function addFranjas($fecha, $hora, $asiento)
    {
        conectar($conectado);

        $sentencia = "INSERT INTO franja (fecha, horaInicio, idAsiento) VALUES ('" . $fecha . "','" . $hora . "','" . $asiento . "')";

        if (!$conectado->query($sentencia)) {

            echo "<p>Hubo un error al ejecutar la sentencia de inserción: {$conectado->error}</p>";
        }

        $conectado->close();
    }

    function selectIdAsiento($idBiblioteca, $planta)
    {
        conectar($conectado);

        $sentencia = "SELECT * FROM asiento WHERE `idBiblioteca` = '" . $idBiblioteca . "' AND `planta`='" . $planta . "'";
        $resultado = $conectado->query($sentencia);

        $lecturaArray = [];
        while ($fila = $resultado->fetch_assoc()) {
            array_push($lecturaArray, $fila['idAsiento']);
        }


        $conectado->close();
        return $lecturaArray;
    }

    function getPlantas($idBiblioteca)
    {
        conectar($conectado);

        $sentencia = "SELECT DISTINCT (`planta`) FROM `asiento` WHERE `idBiblioteca`=" . $idBiblioteca . ";";
        $resultado = $conectado->query($sentencia);

        $plantasArray = [];
        while ($fila = $resultado->fetch_assoc()) {
            array_push($plantasArray, $fila['planta']);
        }


        $conectado->close();
        return $plantasArray;
    }

    //************** PRUEBAS SUMANDO FECHAS ***************//
    /*$fecha = new DateTime('2024-05-29');
    for ($i = 0; $i < 10; $i++) {
        $fecha->add(new DateInterval('P1D'));
        echo $fecha->format('Y-m-d') . "<br>";
    }*/


    //************** PRUEBAS SUMANDO HORAS ***************//
    /*$fecha = new DateTime('10:00:00');
    for ($i = 0; $i < 10; $i++) {
        $fecha->add(new DateInterval('PT1H'));
        echo $fecha->format('H:i:s') . "<br>";
    }*/

    // ************* Obtener la fecha actual formateada ******************//
    /*$today = new DateTime('now', new DateTimeZone('Europe/Madrid'));
    $today->format('Y-m-d');*/

    //*************** INSERCIÓN DE RANGO DE FECHAS ****************/
    // Seleccionar asientos para insertar franjas. En este caso, planta 0 de la biblioteca con id=3.
    $arrayAsientos = selectIdAsiento('3', '0');

    // Para cada asiento, aplicar la función de insertar franjas entre las 09:00 y las 13:00, en un rango de fechas de 5 días
    $fechaFranja = new DateTime('2024-05-27 09:00:00');
    // echo "fecha: " . $fechaFranja->format('Y-m-d');
    // echo "<br>hora: " . $fechaFranja->format('H:i:s');
    $soloHora = $fechaFranja->format('H');
    // echo "<br>hora: " . $soloHora;
    $soloMinuto = $fechaFranja->format('i');
    // echo "<br>minuto: " . $soloMinuto;

    for ($j = 0; $j < 14; $j++) {
        for ($i = 0; $i < 6; $i++) {
            foreach ($arrayAsientos as $a) {
                addFranjas($fechaFranja->format('Y-m-d'), $fechaFranja->format('H:i:s'), $a);
            }

            $fechaFranja->add(new DateInterval('PT1H'));

            if ($i == 4) {
                $fechaFranja->setTime($soloHora, $soloMinuto);
                $fechaFranja->add(new DateInterval('P1D'));
            }
        }
    }
