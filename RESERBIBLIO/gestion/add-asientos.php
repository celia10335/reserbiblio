<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Título -->
    <title>Añadir asientos</title>

    <!-- Fav icon-->
    <link rel="icon" type="image/x-icon" href="../img/logo-sin_fondo.png">

    <!-- Fuentes de Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Expletus+Sans:ital,wght@0,400..700;1,400..700&family=Gayathri:wght@100;400;700&family=KoHo:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />


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

    function addAsientos($dato1, $dato2, $dato3)
    {
        conectar($conectado);

        $sentencia = "INSERT INTO asiento (`planta`, `idBiblioteca`, `descripcion`) VALUES (" . $dato1 . "," . $dato2 . ",'" . $dato3 . "')";

        if (!$conectado->query($sentencia)) {

            echo "<p>Hubo un error al ejecutar la sentencia de inserción: {$conectado->error}</p>";
        }

        $conectado->close();
    }

    function limpiarFormulario($c1, $c2, $c3)
    {
        unset($c1);
        unset($c2);
        unset($c3);
    }

    // ************ Insertar asientos para cada biblioteca ***************
    // $j son las diferentes plantas de la biblioteca. $i son los asientos por cada planta.
    // La biblioteca con ID=1 se supone que tiene 3 plantas (0,1 y 2) con 10 asientos cada una.
    /* for ($i = 1; $i <= 10; $i++) {
        for ($j = 0; $j < 3; $j++) {
            addAsientos($j, '1', 'Asiento ' . $i);
        }
    }

    // La biblioteca con ID=2 se supone que tiene 2 plantas (0 y 1) con 8 asientos cada una.
    for ($i = 1; $i <= 8; $i++) {
        for ($j = 0; $j < 2; $j++) {
            addAsientos($j, '2', 'Asiento ' . $i);
        }
    }

    // La biblioteca con ID=3 se supone que tiene 1 planta (0) con 15 asientos.
    for ($i = 1; $i <= 15; $i++) {
        for ($j = 0; $j < 1; $j++) {
            addAsientos($j, '3', 'Asiento ' . $i);
        }
    }*/



    ?>

    <main>
        <h1>Formulario para grabar número de asientos en la base de datos</h1>
        <form id='formularioAsientos' action="#" method="get">

            <div class="grupoForm">
                <label for="biblioteca">Seleccione una biblioteca:</label>
                <select name="biblioteca" id="biblioteca">
                    <option value="">--Elija biblioteca--</option>
                    <option value="1">Biblioteca "Adolfo Suárez"</option>
                    <option value="2">Biblioteca "Miguel Hernández"</option>
                    <option value="3">Centro Cultural "Estación del Ferrocarril"</option>
                </select>
            </div>

            <div class="grupoForm">
                <label for="numPlantas">Indique el número de plantas</label>
                <input type="number" name="plantas" id="plantas" min='1' max='5'>
            </div>

            <div class="grupoForm">
                <label for="numAsientos">Indique el número de asientos por planta</label>
                <input type="number" name="asientos" id="asientos" min='1' max='20'>
            </div>

            <div class="grupoForm">
                <input type="submit" class="botonForm" value="Generar asientos">
                <input type="reset" class="botonForm" value="Borrar formulario" <?php
                                                                                if (!empty($_GET['biblioteca']) && !empty($_GET['plantas']) && !empty($_GET['asientos'])) {
                                                                                ?>
                    onclick="limpiarFormulario(<?= $_GET['biblioteca'] ?>, <?= $_GET['plantas'] ?>, <?= $_GET['asientos'] ?>)">


                <?php
                                                                                }
            ?>
            </div>



            <?php
            if (!empty($_GET['biblioteca']) && !empty($_GET['plantas']) && !empty($_GET['asientos'])) {

                try {
                    for ($i = 1; $i <= $_GET['asientos']; $i++) {
                        for ($j = 0; $j < $_GET['plantas']; $j++) {
                            addAsientos($j, $_GET['biblioteca'], 'Asiento ' . $i);
                        }
                    }
                    echo "<p>Se han generado asientos con estos parámetros:<br>Biblioteca con ID " . $_GET['biblioteca'] . "<br>" . $_GET['biblioteca'] . " plantas<br>" . $_GET['asientos'] . " asientos</p>";
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            }
            ?>

        </form>

        <div class="a-inicio">
            <a href="index.php">
                <div>
                    <p>Volver a inicio</p>
                </div>
            </a>
        </div>
    </main>

</body>

</html>