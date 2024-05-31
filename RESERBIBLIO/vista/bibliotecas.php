<!-- Hojas de estilo -->
<link rel="stylesheet" href="estilos/jquery-ui.css">
<link rel="stylesheet" href="estilos/calendario.css">
<link rel="stylesheet" href="estilos/bibliotecas.css" />

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
        <!-- ******************** CUERPO PRINCIPAL ********************** -->

        <section class="hero">
            <div>
                <img src="img/logo-sin_fondo.png" alt="Logo Reserbiblio">
                <h1>RESERBIBLIO</h1>
                <img src="img/logo-libro.png" alt="Imagen libro">
            </div>

            <p>La nueva aplicación para reservar plaza de estudio en tu biblioteca favorita de Ceuta</p>
        </section>

        <section class="principal">
            <h2>ELIGE BIBLIOTECA</h2>
            <p>
                Selecciona en qué biblioteca deseas reservar plaza para estudiar.
            </p>
            <div class="bibliotecas">

                <?php
                foreach ($dataToView as $dat) {
                    echo '<a href="index.php?controller=bibliotecaControl&action=verFechas&idBiblioteca=' . $dat->getIdBiblioteca() . '">
                <div class="tarjeta">
                    <div>
                         <h3>' . $dat->getNomBiblio() . '</h3>
                    </div>
                    <div>
                        <p>' . $dat->getDireccionBiblio() . '</p>           <p>Teléfono: ' . $dat->getTlfBiblio() . ' - Email: ' . $dat->getEmailBiblio() . '</p>
                    </div>
                    <div class="foto"></div>
                    <div class="desktop">
                         Seleccionar
                    </div>
                </div></a>';
                }

                ?>

            </div>
            </div>
        </section>
    </main>
</body>

</html>