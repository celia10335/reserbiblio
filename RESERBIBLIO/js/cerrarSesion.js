function cerrarSesion() {
    let iconoUsuario = document.querySelector('div.mobile');
    let botonCerrar = document.querySelector('div.cerrarSesion');
    iconoUsuario.addEventListener('click', function () {
        botonCerrar.classList.toggle('visible');

    });
}