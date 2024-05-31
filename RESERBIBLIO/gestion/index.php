<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Título -->
    <title>RESERBIBLIO gestión</title>

    <!-- Fav icon-->
    <link rel="icon" type="image/x-icon" href="../img/logo-sin_fondo.png">

    <!-- Fuentes de Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Expletus+Sans:ital,wght@0,400..700;1,400..700&family=Gayathri:wght@100;400;700&family=KoHo:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />


    <!-- Iconos Font Awesome -->
    <script src="https://kit.fontawesome.com/442e6a0d83.js" crossorigin="anonymous"></script>

    <!-- Hojas de estilo -->
    <link rel="stylesheet" href="estilos_gestion/estiloGestion.css" />
</head>

<body>
    <main>
        <div class="imgInicio">
            <img src="../img/logo-sin_fondo.png" alt="Logo de Reserbiblio" class="logoInicio">
        </div>
        <h1>
            Bienvenido/a a la aplicación de gestión de <span class="gestionInicio">RESERBIBLIO</span>
        </h1>
        <p> Desde aquí puede
            añadir asientos a la base de datos para una biblioteca concreta para, posteriormente, registrar las horas y
            fechas en que estará disponible para reservas.</p>
        <div class="inicio">
            <a href="add-asientos.php">
                <div class="a-asientos">
                    <p>Añadir asientos</p>
                    <i class="fa-solid fa-chair"></i>
                </div>
            </a>

            <a href="add-franjas.php">
                <div class="a-franjas">
                    <p>Añadir franjas</p>
                    <i class="fa-solid fa-calendar-days"></i>
                </div>
            </a>
        </div>
    </main>

</body>

</html>