<!-- Hojas de estilo -->
<link rel="stylesheet" href="estilos/jquery-ui.css">
<link rel="stylesheet" href="estilos/calendario.css">
<link rel="stylesheet" href="estilos/bibliotecas.css" />

<!-- JavaScript -->
<script src="js/jquery.js"></script>
<script src="js/eligeFecha.js"></script>
<script src='js/cartela.js'></script>

<!-- jQuery -->
<script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>

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
            <h2>SELECCIONAR FECHA</h2>
            <P>Elige una fecha para reservar tu plaza de estudio.</P>
            <div id="datepicker"></div>
            <form action="#" method="post">
                <input type="text" id="fecha" name="fecha">
                <div class="botones">
                    <input type="submit" name="aceptar" id="aceptar" class="aceptar" value="Aceptar">
                    <a href="index.php"><input type="button" id="cancelar" class="volver" value="Cancelar"></a>
                </div>
            </form>



            <?php


            $idBiblioteca = $_GET['idBiblioteca'];

            if (isset($_POST['fecha'])) {
                $fechaForm = formateoFechas($_POST['fecha']);
            }



            if (empty($dataToView->getArrayFechas())) {
                echo "<script>
            window.alert('No hay plazas disponibles');
            </script>";
            }
            if (isset($_POST['fecha'])) {
                $match = false;
                foreach ($dataToView->getArrayFechas() as $f) {
                    if ($f == $fechaForm) {
                        $match = true;
                    }
                }
                if (!($match)) {
                    echo "<script>
                window.alert('Fecha no disponible');
            </script>";
                } else {
                    echo "<div class='botones'><a href='index.php?controller=bibliotecaControl&action=verHoras&idBiblioteca=" . $idBiblioteca . "&fecha=" . $fechaForm . "'><button class='botonMitad'>Elegir hora</button></a></div>";
                }
            }
            ?>
        </section>

    </main>


    <!-- ********* Mostrar información de la biblioteca -->

    <?php
    echo "<script>traerDatos(" . $idBiblioteca . ")</script>";
    ?>