function traerDatos(idBiblioteca) {
    fetch('./AJAX/ver_datos_json.php?idBiblioteca=' + idBiblioteca)
        .then((respuesta) => {
            if (respuesta.ok) {
                return respuesta.json();
            } else {
                throw new Error('Los datos no llegaron bien');
            }
        })
        .then(item => {
            let cartela = document.getElementById("cartela");

            let str = "";
            str += "<div class='infoBiblio'><h1>" + item.nomBiblio + "</h1><p>" + item.direccionBiblio + "</p><p>Teléfono: " + item.tlfBiblio + " - Email: " + item.emailBiblio + "</p></div>";
            cartela.style.backgroundImage = "url('img/" + item.rutaImg + "')";


            cartela.innerHTML = str;

        });
}

