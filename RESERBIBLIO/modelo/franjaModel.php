<?php

class Franja
{
    private $idFranja;
    private $fecha;
    private $horaInicio;
    private $planta;
    private $asiento;
    private $nomBiblio;
    private $conectaBase;
    private $nombreTabla = 'franja';


    // ************ Conexión a base de datos ************ //  
    public function conectarBaseDatos()
    {
        $objetoDb = new Db;
        $this->conectaBase = $objetoDb->conection;
    }


    // ************ Constructor ************ //  
    public function __construct($idFranja = null, $fecha = null, $hora = null,  $asiento = null, $planta = null, $nomBiblio = null)
    {
        $this->idFranja = $idFranja;
        $this->fecha = $fecha;
        $this->horaInicio = $hora;
        $this->planta = $planta;
        $this->asiento = $asiento;
        $this->nomBiblio = $nomBiblio;
        $this->nombreTabla;
    }






    // ************ Funciones de CRUD a base de datos ************ //  
    public function insertar($dato1, $dato2, $dato3)
    {
        $this->conectarBaseDatos();

        $sentencia = "INSERT INTO " . $this->nombreTabla . " (fecha, horaInicio, idAsiento) VALUES ('" . $dato1 . "'," . $dato2 . ",'" . $dato3 . "')";

        if ($this->conectaBase->query($sentencia)) {
            echo "<p>Registro insertado con éxito</p>";
        } else {
            echo "<p>Hubo un error al ejecutar la sentencia de inserción: {$this->conectaBase->error}</p>";
        }
        $this->conectaBase->close();
    }

    public function leer()
    {
        $this->conectarBaseDatos();
        $sentencia = "SELECT * FROM " . $this->nombreTabla;
        $resultado = $this->conectaBase->query($sentencia);

        $lecturaArray = [];
        while ($fila = $resultado->fetch_assoc()) {
            array_push($lecturaArray, $fila);
        }

        $this->conectaBase->close();
        return $lecturaArray;
    }

    public function obtenerId($fecha, $hora, $asiento)
    {

        $this->conectarBaseDatos();
        $sentencia = "SELECT `idFranja` FROM " . $this->nombreTabla . " WHERE `fecha` = '" . $fecha . "' AND `horaInicio`='" . $hora . "' AND `idAsiento` = '" . $asiento . "'";
        $resultado = $this->conectaBase->query($sentencia);

        $lecturaArray = [];
        while ($fila = $resultado->fetch_assoc()) {
            $lecturaArray = $fila;
        }

        $this->conectaBase->close();
        return $lecturaArray['idFranja'];
    }


    public function eliminarReserva($idFranja)
    {

        $this->conectarBaseDatos();

        $sentencia = "DELETE FROM reserva WHERE `idFranja`=" . $idFranja . " AND `idLector`=" . $_SESSION['idUsuario'] . ";";

        if ($this->conectaBase->query($sentencia)) {
            $mensaje = "Reserva eliminada con éxito";
        } else {
            echo "<p>Hubo un error al ejecutar la sentencia de inserción: {$this->conectaBase->error}</p>";
        }
        $this->conectaBase->close();

        return $mensaje;
    }



    // ************ Funciones "getter" y "setter" ************ //
    public function getIdFranja()
    {
        return $this->idFranja;
    }

    public function getHoraInicio()
    {
        return $this->horaInicio;
    }
    public function setHoraInicio($hora)
    {
        $this->horaInicio = $hora;
    }

    public function getFecha()
    {
        return $this->fecha;
    }
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    public function getAsiento()
    {
        return $this->asiento;
    }
    public function setAsiento($num)
    {
        $this->asiento = $num;
    }

    public function getNomBiblio()
    {
        return $this->nomBiblio;
    }
    public function getPlanta()
    {
        return $this->planta;
    }
}
