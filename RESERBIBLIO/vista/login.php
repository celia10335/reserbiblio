<!-- Hojas de estilo -->
<link rel="stylesheet" href="estilos/formularios.css" />
</head>

<body>
    <?php
    if ($controlador->header) {
        require_once 'plantillas/header.php';
    }
    ?>

    <main>
        <section class="header">
            <img src="img/logo-sin_fondo.png" alt="Logo Reserbiblio">
            <h1>RESERBIBLIO</h1>
            <img src="img/logo-libro.png" alt="Logo libro">

        </section>

        <section class="contenido">
            <h1>Inicia Sesión</h1>
            <form action="index.php?controller=loginControl&action=logearUsuario" method="post">
                <div class="campoForm">
                    <p><label for="email" class="form-label">Correo electrónico</label></p>
                    <input type="email" class="form-control" id="email" name="email" required />
                </div>
                <div class="campoForm">
                    <p><label for="contrasenya" class="form-label">Contraseña</label></p>
                    <input type="password" class="form-control" id="contrasenya" name="contrasenya" required />
                </div>
                <?php
                if ($dataToView === false) {
                ?>
                <div class="mb-3">
                    <h2>Usuario o contraseña incorrectos.</h2>
                </div>
                <?php
                }
                ?>
                <button type="submit" class="boton">Iniciar sesión</button>
            </form>
            <p>¿No tienes cuenta? Regístrate.</p>
            <a href="index.php?controller=loginControl&action=crear_usuario"><button class="boton">Crear
                    Cuenta</button></a>
        </section>
    </main>

    <script src="js/errorInicioSesion.js"></script>
</body>

</html>