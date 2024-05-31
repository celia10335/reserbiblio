<header>
    <div class="burger">
        <input type="checkbox" />
        <div class="rayitas"><span></span><span></span><span></span></div>
        <div class="menuBurger">
            <nav>
                <ul>
                    <li class="enlace"><a
                            href="index.php?controller=bibliotecaControl&action=verReservasPorIdLector">Mis reservas</a>
                    </li>
                    <li class="enlace"><a href="index.php?action=perfilUsuario">Mi perfil</a></li>
                    <li class="enlaceQr">
                        <p data-sesion="<?= $_SESSION['idUsuario'] ?>" id="verQr">Próxima reserva</p><i
                            class="fa-solid fa-qrcode"></i>
                        <img src="" alt="" id="qrReserva">

                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <div class="logo-rotulo">
        <a href="index.php">
            <img class="logo" src="img/logo-sin_fondo.png" alt="Logo Reserbiblio"></a>
        <h4>RESERBIBLIO</h4>
    </div>
    <div class="menuHorizontal">
        <nav>
            <ul>
                <li class="enlace"><a href="index.php?controller=bibliotecaControl&action=verReservasPorIdLector">Mis
                        reservas</a></li>
                <li class="enlace"><a href="index.php?action=perfilUsuario">Mi perfil</a></li>
            </ul>
        </nav>

    </div>
    <div class="userIcon mobile">
        <i class="fa-regular fa-circle-user"></i>
        <p>Hola, <?= $_SESSION['nomUsuario'] ?></p>
    </div>

    <div class="cerrarSesion"><a href="index.php?action=cerrarSesion"><button>Cerrar sesión</button></a></div>


    <!-- JavaScript -->
    <script src="js/muestraQr.js"></script>
    <script src="js/cerrarSesion.js"></script>
    <script>
    cerrarSesion();
    muestraQr();
    </script>

</header>