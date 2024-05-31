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
            <h2><?= $dataToView ?></h2>
            <div class="botones">
                <a href='index.php'>
                    <button class="toInicio">Volver a inicio</button>
                </a>
            </div>
        </section>
    </main>

</body>

</html>