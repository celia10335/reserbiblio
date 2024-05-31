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
            <h2>Reserva confirmada</h2>
            <div class="botones reservaBoton">
                <a href='index.php'>
                    <button id="cancelar" class="botonMitad">Volver a inicio</button>
                </a>
                <a href='index.php?controller=bibliotecaControl&action=verReservasPorIdLector&idLector=<?= $_SESSION['idUsuario'] ?>'>
                    <button id="toReservas" class="botonMitad">Ver reservas</button>
                </a>
            </div>
        </section>
    </main>



</body>

</html>