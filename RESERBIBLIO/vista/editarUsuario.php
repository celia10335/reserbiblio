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
        <section class="contenido formulario">
            <h2>Introduce tus datos</h2>

            <form action="index.php?controller=loginControl&action=guardarEdicionLector" method="post" id="formulario">
                <div class="campoForm oculto">
                    <h4>Datos de inicio de sesión</h4>

                    <div>
                        <label for="contrasenya" class="floatingInput">Nueva contraseña:</label>
                        <input type="hidden" name="oldPassword" id="contrasenya" class="form-control"
                            value="<?= $dataToView->getContraseya() ?>">
                        <input type="password" name="newPassword" id="contrasenya" class="form-control">
                    </div>


                </div>
                <h4>Datos personales</h4>

                <div>
                    <!-- Nombre -->
                    <div class="campoForm" id="grupo-nombre">
                        <label for="nombre" class="etiqueta">Nombre:</label>
                        <div class="grupoInput">
                            <input type="text" name="nombre" id="nombre" class="form-control" required
                                spellcheck="false" maxlength="50" pattern="([a-zA-ZÀ-ÿ]\s?)+"
                                value="<?= $dataToView->getNombre() ?>">
                            <i class="validacion fa-solid fa-check"></i>
                        </div>
                        <p class="mensajeError">El nombre sólo puede contener letras</p>
                    </div>

                    <!-- Apellido 1 -->
                    <div class="campoForm" id="grupo-apell1">
                        <label for="apell1" class="etiqueta">Primer apellido:</label>
                        <div class="grupoInput">
                            <input type="text" name="apell1" id="apell1" class="form-control" required
                                spellcheck="false" maxlength="50" pattern="([a-zA-ZÀ-ÿ]\s?)+"
                                value="<?= $dataToView->getApell1() ?>">
                            <i class="validacion fa-solid fa-check"></i>
                        </div>
                        <p class="mensajeError">El apellido sólo puede contener letras</p>
                    </div>

                    <!-- Apellido 2 -->
                    <div class="campoForm" id="grupo-apell2">
                        <label for="apell2" class="etiqueta">Segundo apellido: (opcional)</label>
                        <div class="grupoInput">
                            <input type="text" name="apell2" id="apell2" class="form-control" spellcheck="false"
                                maxlength="50" pattern="([a-zA-ZÀ-ÿ]\s?)+" value="<?= $dataToView->getApell2() ?>">
                            <i class="validacion fa-solid fa-check"></i>
                        </div>
                        <p class="mensajeError">El apellido sólo puede contener letras</p>
                    </div>

                    <!-- DNI -->
                    <div class="campoForm" id="grupo-dni">
                        <label for="dni" class="etiqueta">DNI:</label>
                        <div class="grupoInput">
                            <input type="text" name="dni" id="dni" class="form-control" required maxlength="10"
                                pattern="[KLXYZ]?[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKE]"
                                value="<?= $dataToView->getDni() ?>">
                            <i class="validacion fa-solid fa-check"></i>
                        </div>
                        <p class="mensajeError">Debes escribir un DNI correcto</p>
                    </div>

                    <!-- Dirección -->
                    <div class="campoForm" id="grupo-direccion">
                        <label for="direccion" class="etiqueta">Dirección: (opcional)</label>
                        <div class="grupoInput">
                            <input type="text" name="direccion" id="direccion" class="form-control" spellcheck="true"
                                maxlength="75" pattern="([a-zA-ZÀ-ÿ]\/?\.{0,1}\s?)+([0-9]*\º?\-?\s?)*"
                                value="<?= $dataToView->getDireccion() ?>">
                            <i class="validacion fa-solid fa-check"></i>
                        </div>
                        <p class="mensajeError">La dirección no tiene un formato correcto</p>
                    </div>

                    <!-- Código Postal -->
                    <div class="campoForm" id="grupo-codPostal">
                        <label for="codPostal" class="etiqueta">Código Postal:</label>
                        <div class="grupoInput">
                            <input type="text" name="codPostal" id="codPostal" class="form-control" required
                                maxlength="5" pattern="([0-4][0-9]|5[0-2])[0-9]{3}"
                                value="<?= $dataToView->getCodPostal() ?>">
                            <i class="validacion fa-solid fa-check"></i>
                        </div>
                        <p class="mensajeError">El código postal debe estar entre 00000 y 52999</p>
                    </div>

                    <!-- Número de socio -->
                    <div class="campoForm" id="grupo-numSocio">
                        <label for="numSocio" class="etiqueta">Carné de biblioteca: (opcional)</label>
                        <div class="grupoInput">
                            <input type="text" name="numSocio" id="numSocio" class="form-control" maxlength="6"
                                pattern="\d{6}" value="<?= $dataToView->getNumSocio() ?>">
                            <i class="validacion fa-solid fa-check"></i>
                        </div>
                        <p class="mensajeError">El número de socio debe ser un número de seis dígitos</p>

                    </div>
                </div>

                <h4>Datos de contacto</h4>


                <div>
                    <!-- Teléfono -->
                    <div class="campoForm" id="grupo-tlf">
                        <label for="telefono" class="etiqueta">Teléfono:</label>
                        <div class="grupoInput">
                            <input type="tel" name="tlf" id="tlf" class="form-control" required maxlength="12"
                                pattern="\+34([0-9]){9}" value="<?= $dataToView->getTlf() ?>">
                            <i class="validacion fa-solid fa-check"></i>
                        </div>
                        <p class="mensajeError">El teléfono debe ser de un móvil de España, con el +34 delante y nueve
                            dígitos</p>
                    </div>

                </div>

                <div class="botones">
                    <input type="submit" value="Actualizar datos" id="guardar" class="boton">
                    <a href="index.php" id="cancelar"><input type="button" class="boton" value="Cancelar"></a>
                </div>

            </form>

        </section>
    </main>

    <script src="js/validacionForm.js"></script>
</body>

</html>