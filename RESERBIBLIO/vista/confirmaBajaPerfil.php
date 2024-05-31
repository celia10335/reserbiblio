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
    <section class="contenido">
        <h1>Estás a punto de eliminar tu perfil de usuario</h1>
        <h2>¿Estás seguro?</h2>

        <div class="botones">
            <a href='index.php?action=editarLector'>
                <button class="botonMitad">Aceptar</button>
            </a>
            <a href='index.php'>
                <button class="botonMitad">Cancelar</button>
            </a>
        </div>
    </section>

</body>

</html>