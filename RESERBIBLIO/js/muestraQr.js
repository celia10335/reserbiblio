function verQrReserva(id) {
    let imagen = document.getElementById("qrReserva");
    imagen = imagen.getAttribute("src");

    if (imagen == "") {

        new QRious({
            element: document.getElementById("qrReserva"),
            value: 'index.php?controller=bibliotecaControl&action=reservaQr&idLector=' + id

        });
    }
}

function muestraQr() {

    // Elemento que activa la función para mostrar el Qr
    var accionador = document.getElementById("verQr");

    var iconoQr = document.querySelector('i.fa-qrcode');

    var idUsuario = accionador.getAttribute('data-sesion');


    accionador.addEventListener('click', function () {
        iconoQr.style.display = 'none';
        verQrReserva(idUsuario);
    })

}