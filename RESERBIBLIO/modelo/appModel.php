<?php
class App
{
    //Acceso a BD
    private $conection;

    function __construct()
    {
        $this->conectarBaseDatos();
    }

    public function conectarBaseDatos()
    {
        $dbObj = new Db();
        $this->conection = $dbObj->conection;
    }

    public function getLectorById($id)
    {

        if (is_null($id)) return false;

        $sql = "SELECT * FROM usuario u LEFT JOIN lector le ON u.idUsuario = le.idLector WHERE u.idUsuario ='" . $id . "';";
        $result = $this->conection->query($sql);

        $row = $result->fetch_assoc();
        $lector =  new Lector($row['idUsuario'], $row['email'], $row['contrasenya'], $row['nombre'], $row['apell1'], $row['apell2'], $row['dni'], $row['tlf'], $row['direccion'], $row['codPostal'], $row['numSocio']);

        return $lector;
    }



    public function guardarUsuario($dato1, $dato2, $dato3, $dato4, $dato5, $dato6, $dato7, $dato8, $dato9, $numSocio)
    {
        // función de PHP para encriptar contraseña
        $contraCrip = password_hash($dato2, PASSWORD_DEFAULT);

        $sentencia = "INSERT INTO `usuario` (`email`, `contrasenya`, `nombre`, `apell1`, `apell2`, `dni`, `tlf`, `direccion`, `codPostal`) VALUES ('" . $dato1 . "','" . $contraCrip . "','" . $dato3 . "','" . $dato4 . "','" . $dato5 . "','" . $dato6 . "','" . $dato7 . "','" . $dato8 . "','" . $dato9 . "')";

        // ejecutar primera sentencia, sobre tabla Usuario
        mysqli_query($this->conection, $sentencia);

        // Función de PHP para obtener el último id insertado
        $idLector = $this->conection->insert_id;

        $sentenciaSubtipo = "INSERT INTO lector (`idLector`, `numSocio`) VALUES ('" . $idLector . "', '" . $numSocio . "')";
        // ejecutar segunda sentencia, sobre tabla Lector
        mysqli_query($this->conection, $sentenciaSubtipo);

        $lector = new Lector($idLector, $dato1, $contraCrip, $dato3, $dato4, $dato5, $dato6, $dato7, $dato8, $dato9, $numSocio);

        // Almacenar el id en variable de sesión
        $_SESSION['idUsuario'] = $lector->getIdLector();
        $_SESSION['nomUsuario'] = $lector->getNombreLector();

        return $lector;
    }



    public function inicioSesion($contrasenya, $email)
    {

        // Busca en la base de datos un usuario lector con ese email.
        $sentencia = "SELECT * FROM usuario u JOIN lector le ON u.idUsuario = le.idLector WHERE u.email ='" . $email . "'";
        $result = $this->conection->query($sentencia);

        // Si no existe usuario con ese email, la función devuelve false.
        if ($result->num_rows < 1) return false;

        $row = $result->fetch_assoc();

        //Por medio de la función "password_verify", comprueba si hay una contraseña que, al desencriptarla, coincide ocn la introducida por el usuario. Si no es así, la función devuelve false.
        if (!password_verify($contrasenya, $row['contrasenya'])) {
            return false;
        } else {
            // Si no ha habido errores y la ejecución de la función ha llegado al final, se crea una variable de sesión que guarda el id del usuario lector.

            $_SESSION['idUsuario'] = $row['idUsuario'];
            $_SESSION['nomUsuario'] = $row['nombre'];
            // Inicializar bibliotecas
            $reserbiblio = new Biblioteca();
            // return $reserbiblio->leer();
            return true;
        };
    }





    public function close()
    {
        $_SESSION['idUsuario'] = null;
        $_SESSION['nomUsuario'] = null;
        session_destroy();
    }
}
