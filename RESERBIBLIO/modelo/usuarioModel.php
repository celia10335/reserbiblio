<?php

class Usuario
{

    private $idUsuario;
    private $email;
    private $contraseya;
    private $nombre;
    private $apell1;
    private $apell2;
    private $dni;
    private $tlf;
    private $direccion;
    private $codPostal;
    private $conectaBase;
    private $nombreTabla = 'usuario';


    // ************ Conexión a base de datos ************ //  
    public function conectarBaseDatos()
    {
        $objetoDb = new Db;
        $this->conectaBase = $objetoDb->conection;
    }


    // ************ Constructor ************ //  
    public function __construct($dato1 = null, $dato2 = null, $dato3 = null, $dato4 = null, $dato5 = null, $dato6 = null, $dato7 = null, $dato8 = null, $dato9 = null, $dato10 = null)
    {
        $this->idUsuario = $dato1;
        $this->email = $dato2;
        $this->contraseya = $dato3;
        $this->nombre = $dato4;
        $this->apell1 = $dato5;
        $this->apell2 = $dato6;
        $this->dni = $dato7;
        $this->tlf = $dato8;
        $this->direccion = $dato9;
        $this->codPostal = $dato10;
        $this->nombreTabla;
    }


    // ************ Funciones de CRUD a base de datos ************ //  


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

    public function obtenerId($campo1)
    {

        $this->conectarBaseDatos();
        $sentencia = "SELECT `idUsuario` FROM " . $this->nombreTabla . " WHERE `email` = '" . $campo1 . "'";
        $resultado = $this->conectaBase->query($sentencia);

        $lecturaArray = [];
        while ($fila = $resultado->fetch_assoc()) {
            $lecturaArray = $fila;
        }

        $this->conectaBase->close();
        return $lecturaArray['idUsuario'];
    }

    // Actualiza el registro de usuario con sus propios valores de atributos, después de haberse instanciado un lector con los datos recibidos por $_POST.
    public function guardarEdicion()
    {
        $this->conectarBaseDatos();

        $sentencia = "UPDATE " . $this->nombreTabla . " SET `nombre`='" . $this->nombre . "',`apell1`='" . $this->apell1 . "',`apell2`='" . $this->apell2 . "',`dni`='" . $this->dni . "',`tlf`='" . $this->tlf . "',`direccion`='" . $this->direccion . "',`codPostal`='" . $this->codPostal . "' WHERE `idUsuario`='" . $this->idUsuario . "'";

        if ($this->conectaBase->query($sentencia)) {
            $mensaje = "<p>Datos actualizados con éxito</p>";
        } else {
            $mensaje = "<p>Hubo un error al ejecutar la sentencia de inserción: {$this->conectaBase->error}</p>";
        }
        $this->conectaBase->close();
        return $mensaje;
    }

    public function eliminar($idRegistro)
    {

        $this->conectarBaseDatos();

        $sentencia = "DELETE FROM " . $this->nombreTabla . " WHERE `idUsuario`=" . $idRegistro;

        if ($this->conectaBase->query($sentencia)) {
            echo "<p>Tus datos han sido eliminados y ya no figuras como usuario de esta aplicación.</p>";
        } else {
            echo "<p>Hubo un error al ejecutar la sentencia de inserción: {$this->conectaBase->error}</p>";
        }

        $_SESSION['idUsuario'] = null;
        $_SESSION['nomUsuario'] = null;
        session_destroy();
        $this->conectaBase->close();
    }



    // ************ Funciones "getter" y "setter" ************ //
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getContraseya()
    {
        return $this->contraseya;
    }

    public function setContraseya($char)
    {
        $this->contraseya = $char;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getApell1()
    {
        return $this->apell1;
    }

    public function setApell1($apellido)
    {
        $this->apell1 = $apellido;
    }

    public function getApell2()
    {
        return $this->apell2;
    }

    public function setApell2($apellido)
    {
        $this->apell2 = $apellido;
    }

    public function getDni()
    {
        return $this->dni;
    }

    public function setDni($char)
    {
        $this->dni = $char;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }
    public function setDireccion($texto)
    {
        $this->direccion = $texto;
    }

    public function getTlf()
    {
        return $this->tlf;
    }
    public function setTlf($num)
    {
        $this->tlf = $num;
    }

    public function getCodPostal()
    {
        return $this->codPostal;
    }

    public function setCodPostal($char)
    {
        $this->codPostal = $char;
    }

    public function getConectaBase()
    {
        return $this->conectaBase;
    }

    public function getNombreTabla()
    {
        return $this->nombreTabla;
    }
}
