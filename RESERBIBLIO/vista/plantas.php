<!-- Hojas de estilo -->
<link rel="stylesheet" href="estilos/bibliotecas.css" />
<link rel="stylesheet" href="estilos/horas.css">

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
    ?>
    <main>

        <section id="cartela"></section>

        <section class="principal">

            <?php
            $fechaElegida = $_GET['fecha'];
            $horasSeleccion = $_POST['recogeDatos'];
            $idBiblioteca = $_GET['idBiblioteca'];
            ?>

            <h2>ELIGE PLANTA</h2>

            <div class="cajaDatos">
                <div>
                    <p class="resumen">Fecha elegida: <?= $fechaElegida ?>; <br>Horas seleccionadas:
                        <?= $horasSeleccion ?>;</p>
                </div>

                <?php
                foreach ($dataToView->getArrayPlantas() as $planta) {
                    echo "<a href='index.php?controller=bibliotecaControl&action=verAsientos&idBiblioteca=" . $idBiblioteca . "&planta=" . $planta . "&fecha=" . $fechaElegida . "&horasSeleccion=" . $horasSeleccion . "'>
                <button class='datoUnidad numPlanta'><p>Planta: " . $planta . "</p></button></a><br>";
                }
                ?>
            </div>

            <div class="botones">
                <input type="button" id="aceptar" class="aceptar" name="aceptar" value="Aceptar">
                <a href="index.php"><input type="button" id="cancelar" class="volver" value="Cancelar"></a>
            </div>

        </section>

    </main>

    <!-- ********* Mostrar información de la biblioteca -->


    <?php
    echo "<script>traerDatos(" . $idBiblioteca . ")</script>";
    ?>
</body>

</html>