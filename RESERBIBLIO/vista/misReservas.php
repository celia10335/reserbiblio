<!-- Hojas de estilo -->
<link rel="stylesheet" href="estilos/bibliotecas.css" />
<link rel="stylesheet" href="estilos/reserva.css">

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
            <h2>GESTIONAR RESERVAS</h2>
            <p>Aquí puedes consultar tus reservas o eliminarlas.</p>

        </section>

        <section class="verReservas">


            <?php

            foreach ($dataToView as $franja) {
                echo "<div class='reservaItem'>
                <div>
                    <p>" . $franja->getNomBiblio() . "</p>
                    <p>Planta " . $franja->getPlanta()  . ", " . $franja->getAsiento()  . ";</p>
                    <p>" . $franja->getHoraInicio()  . ":00 - " . $franja->getHoraInicio() + 1  . ":00 horas</p>
                </div>
                <div>
                    <div class='fechaItem'>
                        " . $franja->getFecha()  . "
                    </div>
                    <div class='control'>
                        <a href='index.php?controller=bibliotecaControl&action=eliminarReserva&idFranja=" . $franja->getIdFranja() . "'><i class='fa-solid fa-trash-can'></i></a>
                    </div>
                </div>
            </div>";
            }

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