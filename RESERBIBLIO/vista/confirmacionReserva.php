<!-- Hojas de estilo -->
<link rel="stylesheet" href="estilos/bibliotecas.css" />
<link rel="stylesheet" href="estilos/reserva.css">

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
    $asiento = $_GET['idAsiento'];
    $controladorAuxiliar = new bibliotecaControl;
    $planta = $controladorAuxiliar->infoAsientoReservado()->getPlanta();
    $descripcionAsiento = $controladorAuxiliar->infoAsientoReservado()->getDescripcion();

    ?>

    <main>
        <section id="cartela"></section>

        <section class="principal">

            <h2>DATOS DE TU RESERVA</h2>
            <p>
                Comprueba los datos y, si son correctos, presiona el botón "Aceptar".
            </p>

            <div class="reserva">

                Fecha de la reserva: <?= $fechaElegida ?>
                <br>Hora:
                <?php
                foreach ($dataToView->getArrayFranjas() as $f) {
                    echo $f->getHoraInicio() . ", ";
                };
                ?>
                <br><?= $descripcionAsiento ?></p>

            </div>

            <div class="botones reservaBoton">
                <a href='index.php?controller=bibliotecaControl&action=confirmarReserva&idFranjas=
        <?php
        foreach ($dataToView->getArrayFranjas() as $f) {
            echo $f->getIdFranja() . ",";
        };
        ?>'>
                    <button id="aceptar" class="botonMitad">Confirmar reserva</button>
                </a>
                <a href='index.php'>
                    <button id="cancelar" class="botonMitad">Cancelar</button>
                </a>
            </div>
        </section>
    </main>

    <!-- ********* Mostrar información de la biblioteca -->
    <?php
    echo "<script>traerDatos(" . $idBiblioteca . ")</script>";
    ?>
</body>

</html>