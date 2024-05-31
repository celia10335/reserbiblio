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
            <h2>Introduce tus datos</h2>

            <form action="index.php?controller=loginControl&action=guardar_usuario" method="post" id="formulario">
                <div>
                    <h4 class="seccionFormulario">Datos de inicio de sesión</h4>

                    <!-- Email -->
                    <div class="campoForm" id="grupo-email">
                        <label for="email" class="etiqueta">Mail:</label>
                        <div class="grupoInput">
                            <input type="text" name="email" id="email" class="form-control" autofocus
                                placeholder="nombre@email.com" required spellcheck="false" maxlength="50"
                                pattern="(\-*\w\-*)+[\@][a-zA-Z0-9]+[\.][a-zA-Z]+">
                            <i class="validacion fa-solid fa-check"></i>
                        </div>
                        <p class="mensajeError">Debes escribir un email en formato válido</p>
                        <!-- <i class="fa-regular fa-circle-xmark"></i> -->
                    </div>

                    <!-- Contraseña -->
                    <div class="campoForm" id="grupo-contrasenya">
                        <label for="contrasenya" class="etiqueta">Contraseña:</label>
                        <div class="grupoInput">
                            <input type="password" name="contrasenya" id="contrasenya" class="form-control" required
                                spellcheck="false" minlength="8" maxlength="20"
                                pattern="^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[\!\@\$\%\&\/\(\)\*\.\,\-\+])\S{8,20}">
                            <i class="validacion fa-solid fa-check"></i>
                        </div>
                        <p class="mensajeError">La contraseña debe tener una letra mayúscula, una minúscula, un número y
                            un carácter especial (!@$%&/()*.,-+) sin espacios. Debe tener entre 8 y 20 caracteres</p>
                    </div>


                </div>
                <h4 class="seccionFormulario">Datos personales</h4>
                <div>
                    <!-- Nombre -->
                    <div class="campoForm" id="grupo-nombre">
                        <label for="nombre" class="etiqueta">Nombre:</label>
                        <div class="grupoInput">
                            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre"
                                required spellcheck="false" maxlength="50" pattern="([a-zA-ZÀ-ÿ]\s?)+">
                            <i class="validacion fa-solid fa-check"></i>
                        </div>
                        <p class="mensajeError">El nombre sólo puede contener letras</p>
                    </div>

                    <!-- Apellido 1 -->
                    <div class="campoForm" id="grupo-apell1">
                        <label for="apell1" class="etiqueta">Primer apellido:</label>
                        <div class="grupoInput">
                            <input type="text" name="apell1" id="apell1" class="form-control"
                                placeholder="Primer apellido" required spellcheck="false" maxlength="50"
                                pattern="([a-zA-ZÀ-ÿ]\s?)+">
                            <i class="validacion fa-solid fa-check"></i>
                        </div>
                        <p class="mensajeError">El apellido sólo puede contener letras</p>
                    </div>

                    <!-- Apellido 2 -->
                    <div class="campoForm" id="grupo-apell2">
                        <label for="apell2" class="etiqueta">Segundo apellido: (opcional)</label>
                        <div class="grupoInput">
                            <input type="text" name="apell2" id="apell2" class="form-control"
                                placeholder="Segundo apellido" spellcheck="false" maxlength="50"
                                pattern="([a-zA-ZÀ-ÿ]\s?)+">
                            <i class="validacion fa-solid fa-check"></i>
                        </div>
                        <p class="mensajeError">El apellido sólo puede contener letras</p>
                    </div>

                    <!-- DNI -->
                    <div class="campoForm" id="grupo-dni">
                        <label for="dni" class="etiqueta">DNI:</label>
                        <div class="grupoInput">
                            <input type="text" name="dni" id="dni" class="form-control" placeholder="00000000A" required
                                maxlength="10" pattern="[KLXYZ]?[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKE]">
                            <i class="validacion fa-solid fa-check"></i>
                        </div>
                        <p class="mensajeError">Debes escribir un DNI correcto</p>
                    </div>

                    <!-- Dirección -->
                    <div class="campoForm" id="grupo-direccion">
                        <label for="direccion" class="etiqueta">Dirección: (opcional)</label>
                        <div class="grupoInput">
                            <input type="text" name="direccion" id="direccion" class="form-control"
                                placeholder="Dirección completa" spellcheck="true" maxlength="75"
                                pattern="([a-zA-ZÀ-ÿ]\/?\.{0,1}\s?)+([0-9]*\º?\-?\s?)*">
                            <i class="validacion fa-solid fa-check"></i>
                        </div>
                        <p class="mensajeError">La dirección no tiene un formato correcto</p>
                    </div>

                    <!-- Código Postal -->
                    <div class="campoForm" id="grupo-codPostal">
                        <label for="codPostal" class="etiqueta">Código Postal:</label>
                        <div class="grupoInput">
                            <input type="text" name="codPostal" id="codPostal" class="form-control" placeholder="12345"
                                required maxlength="5" pattern="([0-4][0-9]|5[0-2])[0-9]{3}">
                            <i class="validacion fa-solid fa-check"></i>
                        </div>
                        <p class="mensajeError">El código postal debe estar entre 00000 y 52999</p>
                    </div>

                    <!-- Número de socio -->
                    <div class="campoForm" id="grupo-numSocio">
                        <label for="numSocio" class="etiqueta">Carné de biblioteca: (opcional)</label>
                        <div class="grupoInput">
                            <input type="text" name="numSocio" id="numSocio" class="form-control"
                                placeholder="Núm. carné de bibblioteca (opcional)" maxlength="6" pattern="\d{6}">
                            <i class="validacion fa-solid fa-check"></i>
                        </div>
                        <p class="mensajeError">El número de socio debe ser un número de seis dígitos</p>

                    </div>
                </div>

                <h4 class="seccionFormulario">Datos de contacto</h4>

                <div>
                    <!-- Teléfono -->
                    <div class="campoForm" id="grupo-tlf">
                        <label for="telefono" class="etiqueta">Teléfono:</label>
                        <div class="grupoInput">
                            <input type="tel" name="tlf" id="tlf" class="form-control" placeholder="+346....." required
                                maxlength="12" pattern="\+34([0-9]){9}">
                            <i class="validacion fa-solid fa-check"></i>
                        </div>
                        <p class="mensajeError">El teléfono debe ser de un móvil de España, con el +34 delante y nueve
                            dígitos</p>
                    </div>

                </div>

                <div class="botones">
                    <input type="submit" value="Crear usuario" id="guardar" class="boton">
                    <a href="index.php" id="cancelar"><input type="button" class="boton" value="Cancelar"></a>
                </div>

            </form>

        </section>
    </main>
    <script src="js/validacionForm.js"></script>
</body>

</html>