<!-- Hojas de estilo -->
<link rel="stylesheet" href="estilos/bibliotecas.css" />
<link rel="stylesheet" href="estilos/horas.css">
<link rel="stylesheet" href="estilos/asientos.css">

<!-- JavaScript -->
<script src='js/cartela.js'></script>

<!-- Librería QR -->
<script src="https://unpkg.com/qrious@4.0.2/dist/qrious.js"></script>

</head>

<body>

    <?php
    if ($controlador->header) {
        require_once 'plantillas/header.php';
    }
    $idBiblioteca = $_GET['idBiblioteca'];
    $fechaElegida = $_GET['fecha'];
    $horasSeleccion = $_GET['horasSeleccion'];
    $planta = $_GET['planta'];
    ?>

    <main>
        <section id="cartela"></section>

        <section class="principal">

            <h2>ELIGE ASIENTO</h2>
            <p>Selecciona el asiento deseado.</p>

            <div class="cajaDatos">
                <div>
                    <p>Fecha elegida: <?= $fechaElegida ?> - Horario: <?= $horasSeleccion ?>;
                        <br>Planta: <?= $planta ?>
                    </p>
                </div>
                <div>
                    <?php
                    foreach ($dataToView->getArrayAsientos() as $asiento) {
                        echo "<a href='index.php?controller=bibliotecaControl&action=crearReserva&idBiblioteca=" . $idBiblioteca . "&fecha=" . $fechaElegida . "&horasSeleccion=" . $horasSeleccion . "&idAsiento=" . $asiento[0] . "'>
                <button class='datoUnidad asiento'>&nbsp</button>
                </a><br>";
                    } ?>
                </div>
            </div>


            <div class="botones">
                <input type="button" id="aceptar" class="aceptar" name="aceptar" value="Aceptar">
                <a href="index.php"><input type="button" id="cancelar" class="volver" value="Cancelar"></a>
            </div>
        </section>



    </main>

    <?php
    echo "<script>traerDatos(" . $idBiblioteca . ")</script>";
    ?>

</body>

</html>