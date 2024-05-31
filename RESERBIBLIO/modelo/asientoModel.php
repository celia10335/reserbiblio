<?php

class Asiento
{

    private $idAsiento;
    private $planta;
    private $idBiblioteca;
    private $descripcion;
    private $conectaBase;
    private $nombreTabla = 'asiento';


    // ************ Conexión a base de datos ************ //  
    public function conectarBaseDatos()
    {
        $objetoDb = new Db;
        $this->conectaBase = $objetoDb->conection;
    }


    // ************ Constructor ************ //  
    public function __construct($idAsiento = null, $planta = null, $idBiblioteca = null, $descripcion = null)
    {
        $this->idAsiento = $idAsiento;
        $this->planta = $planta;
        $this->idBiblioteca = $idBiblioteca;
        $this->descripcion = $descripcion;
        $this->nombreTabla;
    }




    // ************ Funciones para el controlador ************ // 






    // ************ Funciones de CRUD a base de datos ************ //  
    public function insertar($dato1, $dato2, $dato3)
    {
        $this->conectarBaseDatos();

        $sentencia = "INSERT INTO " . $this->nombreTabla . " (planta, idBiblioteca, descripcion) VALUES (" . $dato1 . "," . $dato2 . ",'" . $dato3 . "')";

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

    public function obtenerId($campo1, $campo2, $campo3)
    {

        $this->conectarBaseDatos();
        $sentencia = "SELECT `idAsiento` FROM " . $this->nombreTabla . " WHERE `planta` = '" . $campo1 . "' AND `idBiblioteca`='" . $campo2 . "' AND `descripcion` = '" . $campo3 . "'";
        $resultado = $this->conectaBase->query($sentencia);

        $lecturaArray = [];
        while ($fila = $resultado->fetch_assoc()) {
            $lecturaArray = $fila;
        }

        $this->conectaBase->close();
        return $lecturaArray['idAsiento'];
    }

    public function actualizar($nuevoValor1, $nuevoValor2, $nuevoValor3, $idRegistro)
    {
        $this->conectarBaseDatos();

        $sentencia = "UPDATE " . $this->nombreTabla . " SET `planta`='" . $nuevoValor1 . "',`idBiblioteca`='" . $nuevoValor2 . "',`descripcion`='" . $nuevoValor3 . "' WHERE `idAsiento`='" . $idRegistro . "'";

        if ($this->conectaBase->query($sentencia)) {
            echo "<p>Registro actualizado con éxito</p>";
        } else {
            echo "<p>Hubo un error al ejecutar la sentencia de inserción: {$this->conectaBase->error}</p>";
        }
        $this->conectaBase->close();
    }

    public function eliminar($idRegistro)
    {

        $this->conectarBaseDatos();

        $sentencia = "DELETE FROM " . $this->nombreTabla . " WHERE `idAsiento`=" . $idRegistro;

        if ($this->conectaBase->query($sentencia)) {
            echo "<p>Registro eliminado con éxito</p>";
        } else {
            echo "<p>Hubo un error al ejecutar la sentencia de inserción: {$this->conectaBase->error}</p>";
        }
        $this->conectaBase->close();
    }



    // ************ Funciones "getter" y "setter" ************ //
    public function getIdAsiento()
    {
        return $this->idAsiento;
    }
    public function getPlanta()
    {
        return $this->planta;
    }
    public function setPlanta($num)
    {
        $this->planta = $num;
    }
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    public function setDescripcion($texto)
    {
        $this->descripcion = $texto;
    }
    public function getIdBiblioteca()
    {
        return $this->idBiblioteca;
    }
    public function setIdBiblioteca($num)
    {
        $this->idBiblioteca = $num;
    }
}
