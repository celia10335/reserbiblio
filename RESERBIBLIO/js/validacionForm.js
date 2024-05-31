const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll('#formulario input');

const expresiones = {
    email: /^(\-*\w\-*)+[\@][a-zA-Z0-9]+[\.][a-zA-Z]+$/,
    contrasenya: /^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[\!\@\$\%\&\/\(\)\*\.\,\-\+])\S{8,20}$/, // 8 a 20 digitos.
    nombre: /^([a-zA-ZÀ-ÿ]\s?){1,50}$/, // Letras y espacios, pueden llevar acentos. Para los campos "nombre" y los apellidos.
    dni: /^[KLXYZ]?[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKE]$/, //Ocho dígitos y las letras permitidas, opcionalmente la letra de DNI extranjero
    direccion: /^([a-zA-ZÀ-ÿ]\/?\.{0,1}\s?)+([0-9]*\º?\-?\s?)*$/, // Letras, numeros, caracteres "º", "." y "/".
    codPostal: /^([0-4][0-9]|5[0-2])[0-9]{3}/, // Número de cinco cifras hasta el 52000
    numSocio: /^\d{6}$/, // Número de seis cifras
    tlf: /^\+34([0-9]){9}$/ // Prefijo de España más nueve dígitos.
}

// Los campos opcionales (segundo apellido, dirección y número de socio) se inicializan como "true". Si se escribe algo en ellos, entonces se activará la validación, dando "false" si no coincide con la expresión regular.
const campos = {
    email: false,
    contrasenya: false,
    nombre: false,
    apell1: false,
    apell2: true,
    dni: false,
    direccion: true,
    codPostal: false,
    numSocio: true,
    tlf: false
}

const validarFormulario = (e) => {
    switch (e.target.name) {
        case "email":
            validarCampo(expresiones.email, e.target, 'email');
            break;
        case "contrasenya":
            validarCampo(expresiones.contrasenya, e.target, 'contrasenya');
            break;
        case "nombre":
            validarCampo(expresiones.nombre, e.target, 'nombre');
            break;
        case "apell1":
            validarCampo(expresiones.nombre, e.target, 'apell1');
            break;
        case "apell2":
            if (e.target.value != '') {
                validarCampo(expresiones.nombre, e.target, 'apell2');
            }
            break;
        case "dni":
            validarCampo(expresiones.dni, e.target, 'dni');
            break;
        case "direccion":
            if (e.target.value != '') {
                validarCampo(expresiones.direccion, e.target, 'direccion');
            }
            break;
        case "codPostal":
            validarCampo(expresiones.codPostal, e.target, 'codPostal');
            break;
        case "numSocio":
            if (e.target.value != '') {
                validarCampo(expresiones.numSocio, e.target, 'numSocio');
            }
            break;
        case "tlf":
            validarCampo(expresiones.tlf, e.target, 'tlf');
            break;
    }
}

const validarCampo = (expresion, input, campo) => {
    if (expresion.test(input.value)) {
        // Apariencia del input
        document.getElementById(`grupo-${campo}`).classList.remove('campoIncorrecto');

        // Apariencia del icono al lado del input
        document.querySelector(`#grupo-${campo} i`).classList.add('fa-check');
        document.querySelector(`#grupo-${campo} i`).classList.remove('fa-circle-xmark');

        // Mostrar u ocultar mensaje de error
        document.querySelector(`#grupo-${campo} p.mensajeError`).classList.remove('hayError');
        campos[campo] = true;
    } else {
        // Apariencia del input
        document.getElementById(`grupo-${campo}`).classList.add('campoIncorrecto');

        // Apariencia del icono al lado del input
        document.querySelector(`#grupo-${campo} i`).classList.add('fa-circle-xmark');
        document.querySelector(`#grupo-${campo} i`).classList.remove('fa-check');

        // Mostrar u ocultar mensaje de error
        document.querySelector(`#grupo-${campo} p.mensajeError`).classList.add('hayError');
        campos[campo] = false;
    }
}


inputs.forEach((input) => {
    input.addEventListener('keyup', validarFormulario);
    input.addEventListener('blur', validarFormulario);
});
