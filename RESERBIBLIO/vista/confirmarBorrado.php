<!-- Hojas de estilo -->
<link rel="stylesheet" href="estilos/bibliotecas.css" />
<link rel="stylesheet" href="estilos/formularios.css" />

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
            <h2>¿Estás seguro de que quieres eliminar tus datos?</h2>


            <div class="botones">
                <a href='index.php?action=eliminarUsuario'>
                    <button class="botonMitad">Sí, estoy seguro/a</button>
                </a>
                <a href='index.php'>
                    <button class="botonMitad">No, quiero volver</button>
                </a>
            </div>
        </section>
    </main>
</body>

</html>