<?php
// require_once 'usuarioModel.php';
// require_once 'dbModel.php';
// require_once '../config/config.php';

class Lector extends Usuario
{
    private $numSocio;


    // ************ Constructor ************ //  
    public function __construct($dato1, $dato2, $dato3, $dato4, $dato5, $dato6, $dato7, $dato8, $dato9, $dato10, $numSocio)
    {
        parent::__construct($dato1, $dato2, $dato3, $dato4, $dato5, $dato6, $dato7, $dato8, $dato9, $dato10);
        $this->numSocio = $numSocio;
    }


    // ************ Funciones de CRUD a base de datos ************ //  
    public function insertar($dato1, $dato2, $dato3, $dato4, $dato5, $dato6, $dato7, $dato8, $dato9, $numSocio)
    {
        $this->conectarBaseDatos();

        $sentencia = "INSERT INTO " . $this->getNombreTabla() . " (`email`, `contrasenya`, `nombre`, `apell1`, `apell2`, `dni`, `tlf`, `direccion`, `codPostal`) VALUES ('" . $dato1 . "','" . $dato2 . "','" . $dato3 . "','" . $dato4 . "','" . $dato5 . "','" . $dato6 . "','" . $dato7 . "','" . $dato8 . "','" . $dato9 . "')";

        mysqli_query($this->getConectaBase(), $sentencia);

        $idLector = $this->getConectaBase()->insert_id;

        $sentenciaSubtipo = "INSERT INTO lector (`idLector`, `numSocio`) VALUES ('" . $idLector . "', '" . $numSocio . "')";
        mysqli_query($this->getConectaBase(), $sentenciaSubtipo);

        $this->getConectaBase()->close();
    }

    // ************ Funciones "getter" y "setter" ************ //
    public function getIdLector()
    {
        return $this->getIdUsuario();
    }

    public function getNombreLector()
    {
        return $this->getNombre();
    }

    public function getNumSocio()
    {
        return $this->numSocio;
    }

    public function setNumSocio($num)
    {
        $this->numSocio = $num;
    }
}

$lector = new Lector(3, 'poiuytr@ewq.com', '111000', 'Lele', 'Fifi', '', '123456789G', '', '', '', 337003);
//$lector->insertar('poiuytr@ewq.com', '111000', 'Lele', 'Fifi', '', '123456789G', '', '', '', '337070');