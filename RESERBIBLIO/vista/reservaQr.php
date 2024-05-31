<!-- Hojas de estilo -->
<link rel="stylesheet" href="estilos/bibliotecas.css" />
<link rel="stylesheet" href="estilos/reserva.css">

<!-- JavaScript -->
<script src="js/qr.js"></script>

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
        <section class="principal">
            <h2>PRÓXIMA RESERVA</h2>
        </section>

        <section class="verReservas">


            <?php
            // var_dump($dataToView);

            echo "<div class='reservaItem'>
                <div>
                    <p>" . $dataToView->getNomBiblio() . "</p>
                    <p>Planta " . $dataToView->getPlanta()  . ", " . $dataToView->getAsiento()  . ";</p>
                    <p>" . $dataToView->getHoraInicio()  . ":00 - " . $dataToView->getHoraInicio() + 1  . ":00 horas</p>
                </div>
                <div>
                    <div class='fechaItem'>
                        " . $dataToView->getFecha()  . "
                    </div>
                
            </div>
            </div>";
            ?>


            <div class="botones">
                <a href='index.php'>
                    <button class="toInicio">Volver a inicio</button>
                </a>
            </div>
        </section>

    </main>




</body>

</html>