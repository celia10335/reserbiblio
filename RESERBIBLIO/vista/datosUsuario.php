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
            <h2><?= $dataToView->getNombre() . " " . $dataToView->getApell1() . " " . $dataToView->getApell2() ?></h2>
            <table>
                <tr>
                    <td><strong>Teléfono</strong></td>
                    <td><?= $dataToView->getTlf() ?></td>
                </tr>
                <tr>
                    <td><strong>Dirección</strong></td>
                    <td><?= $dataToView->getDireccion() ?></td>
                </tr>
                <tr>
                    <td><strong>Código postal</strong></td>
                    <td><?= $dataToView->getCodPostal() ?></td>
                </tr>
                <tr>
                    <td><strong>DNI</strong></td>
                    <td><?= $dataToView->getDni() ?></td>
                </tr>
                <tr>
                    <td><strong>Carné de biblioteca</strong></td>
                    <td><?= $dataToView->getNumSocio() ?></td>
                </tr>

            </table>
            <div class="botones">
                <a href='index.php?action=editarLector'>
                    <button class="botonMitad">Modificar</button>
                </a>
                <a href='index.php'>
                    <button class="botonMitad">Inicio</button>
                </a>
            </div>

            <hr class="separador">
            <a class="warning" href="index.php?action=solicitudBorrado">Eliminar perfil</a>
        </section>
    </main>
</body>

</html>