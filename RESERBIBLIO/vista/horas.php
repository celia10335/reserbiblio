<!-- Hojas de estilo -->
<link rel="stylesheet" href="estilos/bibliotecas.css" />
<link rel="stylesheet" href="estilos/horas.css">

<!-- JavaScript -->
<script src="js/cartela.js"></script>

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

        <section id="cartela"></section>

        <?php
        $fecha = $_GET['fecha'];
        $idBiblioteca = $_GET['idBiblioteca'];
        ?>

        <section class="principal horas">
            <h2>SELECCIONAR HORA</h2>
            <P>Elige una hora para reservar tu plaza de estudio.</P>

            <form action="index.php?controller=bibliotecaControl&action=seleccionaPlanta&idBiblioteca=<?= $idBiblioteca ?>&fecha=<?= $fecha ?>" method="post">
                <div class="cajaDatos">
                    <div>
                        <p>
                            <?php
                            // Pasa la fecha obtenida por la función "fechaToString" para darle formato más amigable para el usuario
                            $fechaForm = fechaToString($fecha);
                            echo $fechaForm;
                            ?>
                        </p>
                    </div>

                    <div class="contenedorHoras">
                        <!-- Genera un input por cada hora disponible -->
                        <?php
                        foreach ($dataToView->getArrayHoras() as $dat) {
                            echo '<input type="button" class="datoUnidad" value="' . $dat . '">';
                        }

                        ?>
                    </div>
                </div>

                <!-- Recoge las horas seleccionadas por el usuario, en forma de array al que se le han eliminado los elementos duplicados (en caso de que el usuario pulse más de una vez en el botón) -->

                <div class="botones">
                    <input type="submit" id="aceptar" class="aceptar" name="aceptar" value="Aceptar">
                    <a href="index.php"><input type="button" id="cancelar" class="volver" value="Cancelar"></a>
                </div>


                <input type="text" name="recogeDatos" id="recogeDatos">

                <script>
                    horasArray = document.getElementsByClassName("datoUnidad");
                    botonAceptar = document.getElementById('aceptar');
                    recogeDatos = document.getElementById('recogeDatos');


                    let arrayValores = [];

                    for (let i of horasArray) {
                        i.addEventListener('click', function() {
                            arrayValores.push(i.value);
                            i.classList.add('seleccionado');
                        })
                    }


                    botonAceptar.addEventListener('click', function() {

                        // Eliminar elementos duplicados en el array
                        const sinRepetir = arrayValores.reduce((acc, item) => {
                            if (!acc.includes(item)) {
                                acc.push(item);
                            }
                            return acc;
                        }, [])

                        for (let i of sinRepetir) {
                            console.log(i);
                        }

                        recogeDatos.value = sinRepetir;

                    })
                </script>



            </form>
        </section>


    </main>

    <!-- ********* Mostrar información de la biblioteca -->

    <?php

    echo "<script>traerDatos(" . $idBiblioteca . ")</script>";
    ?>

</body>

</html>