<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$controlador->title?></title> -->


<?php
require_once 'plantillas/HTML_head.php';
?>
</head>

<body>

    <main>
        <section class="principal">

            <h1>Usuario insertado</h1>
            <?php
			echo ("<h4>" . $dataToView . "</h4>");
			?>
            <div><a href="index.php">Volver al inicio</a></div>
        </section>
    </main>
</body>

</html>