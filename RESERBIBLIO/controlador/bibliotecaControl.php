<?php

class bibliotecaControl
{

    private $modelo;
    public $view;
    public $title;
    public $header;

    public function __construct()
    {
        $this->modelo = new Biblioteca;
        $this->view = 'bibliotecas';
        $this->title = 'Elige biblioteca';
        $this->header = true;
    }


    public function consultaBibliotecas()
    {
        return $this->modelo->leer();
    }




    // ******************* MOSTRAR FECHAS PARA UNA BIBLIOTECA PASANDO SU ID ***********************
    public function verFechas()
    {
        $this->view = 'calendario';
        $this->title = 'Elige fecha';
        return $this->modelo->fechasPorBiblioteca($_GET['idBiblioteca']);
    }


    // ******************* MOSTRAR HORAS DISPONIBLES PARA UNA FECHA SELECCIONADA Y UN ID DE BIBLIOTECA ***********************
    public function verHoras()
    {
        $this->view = 'horas';
        $this->title = 'Elige hora';
        return $this->modelo->horasPorFecha($_GET['idBiblioteca'], $_GET['fecha']);
    }



    // ******************* MOSTRAR PLANTAS DE BIBLIOTECA ***********************
    public function seleccionaPlanta()
    {
        $this->view = 'plantas';
        $this->title = 'Elige planta';
        return $this->modelo->verPlantas($_GET['idBiblioteca']);
    }

    public function infoAsientoReservado()
    {
        return $this->modelo->datosAsiento($_GET['idAsiento']);
    }


    // ******************* MOSTRAR ASIENTOS PARA ESA FECHA Y HORA ***********************
    public function verAsientos()
    {
        $this->view = 'asientos';
        $this->title = 'Elige asiento';
        return $this->modelo->verAsientosPorFechaHora($_GET['idBiblioteca'], $_GET['fecha'], $_GET['horasSeleccion']);
    }


    // ******************* CREA LA RESERVA CON LOS PARÁMETROS SELECCIONADOS ***********************
    public function crearReserva()
    {
        $this->view = 'confirmacionReserva';
        $this->title = 'Datos de reserva';
        return $this->modelo->preReserva($_GET['idAsiento'], $_GET['fecha'], $_GET['horasSeleccion']);
    }

    public function confirmarReserva()
    {
        $this->view = 'reservaConfirmada';
        $this->title = 'Reserva confirmada';
        $this->modelo->insertarReserva($_GET['idFranjas']);
    }

    // ******************* VER RESERVAS POR ID DE LECTOR ***********************
    public function verReservasPorIdLector()
    {
        $this->view = 'misReservas';
        $this->title = 'Mis reservas';
        return $this->modelo->getReservas($_SESSION['idUsuario']);
    }

    public function reservaQr()
    {
        $this->view = 'reservaQr';
        $this->title = 'Próxima reserva';
        //return $this->modelo->proximaReserva($_SESSION['idUsuario']);
        return $this->modelo->proximaReserva(2);
    }


    public function eliminarReserva()
    {
        $this->view = 'reservaEliminada';
        $this->title = 'Mis reservas';
        $this->modelo = new Franja;
        return $this->modelo->eliminarReserva($_GET['idFranja']);
    }



    // **************** CRUD *******************

    public function insertaBiblioteca($dato1, $dato2, $dato3, $dato4)
    {
        $this->modelo->insertar($dato1, $dato2, $dato3, $dato4);
    }



    public function modificaBiblioteca($nuevoValor1, $nuevoValor2, $nuevoValor3, $nuevoValor4, $idBiblioteca)
    {
        $this->modelo->actualizar($nuevoValor1, $nuevoValor2, $nuevoValor3, $nuevoValor4, $idBiblioteca);
    }

    public function obtenIdBiblioteca($campo1)
    {
        $dato = $this->modelo->obtenerId($campo1);
        return $dato;
    }


    public function eliminaRegistro($idRegistro)
    {
        $this->modelo->eliminar($idRegistro);
    }
}
