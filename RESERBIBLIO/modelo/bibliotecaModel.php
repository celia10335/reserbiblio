<?php

class Biblioteca
{

    private $idBiblioteca;
    private $nomBiblio;
    private $direccionBiblio;
    private $tlfBiblio;
    private $emailBiblio;
    private $img;
    private $arrayFechas = array();
    private $arrayHoras = array();
    private $arrayPlantas = array();
    private $arrayAsientos = array();
    private $arrayFranjas = array();
    private $conectaBase;
    private $nombreTabla = 'biblioteca';


    // ************ Conexión a base de datos ************ //  
    public function conectarBaseDatos()
    {
        $objetoDb = new Db;
        $this->conectaBase = $objetoDb->conection;
    }


    // ************ Constructor ************ //  
    public function __construct($id = null, $nombre = null, $direccion = null, $tlf = null, $email = null, $img = null)
    {
        $this->idBiblioteca = $id;
        $this->nomBiblio = $nombre;
        $this->direccionBiblio = $direccion;
        $this->tlfBiblio = $tlf;
        $this->emailBiblio = $email;
        $this->img = $img;
        $this->arrayFechas = array();
        $this->arrayHoras = array();
        $this->arrayPlantas = array();
        $this->arrayAsientos = array();
        $this->arrayFranjas = array();
        $this->nombreTabla;
    }



    // ******************* PANTALLA DE INICIO CON LAS BIBLIOTECAS EXISTENTES EN LA BASE DE DATOS ***********************
    public function leer()
    {
        try {
            $this->conectarBaseDatos();
            $sentencia = "SELECT * FROM " . $this->nombreTabla;
            $resultado = $this->conectaBase->query($sentencia);

            $lecturaArray = [];
            while ($fila = $resultado->fetch_assoc()) {
                array_push($lecturaArray, new Biblioteca($fila['idBiblioteca'], $fila['nomBiblio'], $fila['direccionBiblio'], $fila['tlfBiblio'], $fila['emailBiblio'], $fila['rutaImg']));
            }

            $this->conectaBase->close();
            return $lecturaArray;
        } catch (Exception $e) {
            $error = $e->getMessage();
            echo 'Algo salió mal: ' .  $error . "<br>";
        }
    }


    // ******************* PANTALLA DE INICIO CON LAS BIBLIOTECAS EXISTENTES EN LA BASE DE DATOS ***********************
    public function getLectorById($id)
    {
        $this->conectarBaseDatos();
        if (is_null($id)) return false;

        $sql = "SELECT * FROM usuario u LEFT JOIN lector le ON u.idUsuario = le.idLector WHERE u.idUsuario ='" . $id . "';";
        $result = $this->conectaBase->query($sql);

        $row = $result->fetch_assoc();
        $lector =  new Lector($row['idUsuario'], $row['email'], $row['contrasenya'], $row['nombre'], $row['apell1'], $row['apell2'], $row['dni'], $row['tlf'], $row['direccion'], $row['codPostal'], $row['numSocio']);

        $this->conectaBase->close();
        return $lector;
    }


    // ******************** TRAER INFORMACIÓN DEL SERVIDOR Y ALMACENARLA EN JSON PARA PROPORCIONAR DATOS DE LA BIBLIOTECA SELECCIONADA **********
    public function datosBiblioJson($id)
    {
        $this->conectarBaseDatos();
        $sentencia = "SELECT * FROM " . $this->nombreTabla . " WHERE `idBiblioteca` = " . $id . ";";
        $resultado = $this->conectaBase->query($sentencia);

        $datosBiblioArray = array();

        if ($resultado->num_rows == 0) {
            return 0;
        } else {
            $fila = $resultado->fetch_assoc();
            return $fila;
        }
        $this->conectaBase->close();
        return $datosBiblioArray;
    }


    public function fechasJson($idBiblioteca)
    {
        $this->conectarBaseDatos();

        $sentencia = "SELECT DISTINCT (`fecha`) from franja WHERE idAsiento IN (SELECT idAsiento FROM asiento WHERE idBiblioteca =" . $idBiblioteca . ") AND `idFranja` != ALL(SELECT `idFranja` FROM reserva);";
        $resultado = $this->conectaBase->query($sentencia);

        $fechasArray = array();

        while ($fila = $resultado->fetch_assoc()) {
            array_push(
                $fechasArray,
                $fila["fecha"]
            );
        }
        $this->conectaBase->close();
        return $fechasArray;
    }




    // ******************* MOSTRAR FECHAS PARA UNA BIBLIOTECA PASANDO SU ID ***********************

    public function fechasPorBiblioteca($idBiblioteca)
    {

        $this->conectarBaseDatos();
        $sentencia = "SELECT DISTINCT (`fecha`) from franja WHERE idAsiento IN (SELECT idAsiento FROM asiento WHERE idBiblioteca =" . $idBiblioteca . ") AND `idFranja` != ALL(SELECT `idFranja` FROM reserva);";

        //SELECT * FROM franja f JOIN asiento a ON f.idAsiento = a.idAsiento WHERE a.idBiblioteca=1 AND f.fecha>'2024-06-01'
        $resultado = $this->conectaBase->query($sentencia);

        while ($fila = $resultado->fetch_assoc()) {
            array_push(
                $this->arrayFechas,
                $fila["fecha"]
            );
        }

        $this->conectaBase->close();
        return $this;
    }



    // ******************* MOSTRAR HORAS PARA UNA FECHA y UNA BIBLIOTECA ***********************
    public function horasPorFecha($idBiblioteca, $fecha)
    {
        $this->conectarBaseDatos();
        $sentencia = "SELECT DISTINCT TIME_FORMAT(`horaInicio`, '%H:%i') AS `horaFormato` from franja WHERE idAsiento IN (SELECT idAsiento FROM asiento WHERE idBiblioteca =" . $idBiblioteca . ") AND `fecha`='" . $fecha . "' AND `idFranja` != ALL(SELECT `idFranja` FROM reserva) ORDER BY `horaFormato`;";
        $resultado = $this->conectaBase->query($sentencia);

        while ($fila = $resultado->fetch_assoc()) {
            array_push(
                $this->arrayHoras,
                $fila["horaFormato"]
            );
        }

        $this->conectaBase->close();
        return $this;
    }


    // ***************** VER LAS PLANTAS DISPONIBLES PARA UNA BIBLIOTECA ********************
    public function verPlantas($idBiblioteca)
    {
        $this->conectarBaseDatos();
        $sentencia = "SELECT DISTINCT `planta` FROM asiento WHERE `idBiblioteca` =" . $idBiblioteca . ";";
        $resultado = $this->conectaBase->query($sentencia);

        while ($fila = $resultado->fetch_assoc()) {
            array_push(
                $this->arrayPlantas,
                $fila["planta"]
            );
        }

        $this->conectaBase->close();
        return $this;
    }


    // ***************** VER LOS ASIENTOS DISPONIBLES PARA LA PLANTA DE UNA BIBLIOTECA ********************
    public function verAsientosPorFechaHora($idBiblioteca, $fecha, $cadenaHoras)
    {
        $horas = explode(",", $cadenaHoras);

        $this->conectarBaseDatos();
        $sentencia = "SELECT f.`idAsiento`, `descripcion` FROM franja f JOIN asiento a ON f.`idAsiento`= a.`idAsiento` WHERE `fecha`='" . $fecha . "' AND DATE_FORMAT(`horaInicio`, '%H:%i')='" . $horas[0] . "'";
        if (count($horas) > 1) {
            for ($i = 1; $i < count($horas); $i++) {

                if ($i < count($horas) - 1) {
                    $sentencia = $sentencia . " AND f.`idAsiento` = ANY (SELECT f.`idAsiento` FROM franja WHERE `fecha`='" . $fecha . "' AND DATE_FORMAT(`horaInicio`, '%H:%i')='" . $horas[$i] . "')";
                } else {
                    $sentencia = $sentencia . " AND f.`idAsiento` = ANY (SELECT f.`idAsiento` FROM franja WHERE `fecha`='" . $fecha . "' AND DATE_FORMAT(`horaInicio`, '%H:%i') ='" . $horas[$i] . "'";
                }
            }
            $sentencia = $sentencia . ")";
        }
        $sentencia = $sentencia . "  AND f.`idFranja` != ALL (SELECT `idFranja` FROM reserva);";
        $resultado = $this->conectaBase->query($sentencia);
        while ($fila = $resultado->fetch_assoc()) {
            array_push(
                $this->arrayAsientos,
                [
                    $fila["idAsiento"],
                    $fila['descripcion']
                ]
            );
        }
        $this->conectaBase->close();
        return $this;
    }



    public function preReserva($idAsiento, $fecha, $cadenaHoras)
    {
        $horas = explode(",", $cadenaHoras);

        $this->conectarBaseDatos();

        foreach ($horas as $h) {
            $sentencia = "SELECT `idFranja`,`fecha`, DATE_FORMAT(`horaInicio`, '%H:%i') AS `hora`,`idAsiento` FROM franja WHERE `idAsiento`=" . $idAsiento . " AND `fecha`='" . $fecha . "' AND DATE_FORMAT(`horaInicio`, '%H:%i')='" . $h . "';";

            $resultado = $this->conectaBase->query($sentencia);

            $row = $resultado->fetch_assoc();

            // Instancia un objeto idFranja para mostrar los datos de la reserva
            $franjaReservada = new Franja($row['idFranja'], $row['fecha'], $row["hora"], $row['idAsiento']);

            // Lo añade al array de franjas
            array_push($this->arrayFranjas, $franjaReservada);
        }

        // Obtiene el id de la franja elegida para, en una consulta posterior, insertar un registro en la tabla "reserva" que asocie ese id de franja con el id del usuario

        $this->conectaBase->close();
        return $this;
    }

    public function insertarReserva($idFranjasReserva)
    {
        $idF = explode(",", $idFranjasReserva);
        array_pop($idF);


        // Variables que se utilizarán para la inserción en la tabla "reserva".
        $idUsuario = $_SESSION['idUsuario'];
        $this->conectarBaseDatos();
        foreach ($idF as $f) {

            //Comprueba que no exista un registro con los mismos datos
            $sentencia = "SELECT * FROM reserva WHERE `idLector`=" . $idUsuario . " AND `idFranja`='" . $f . "';";
            $resultado = $this->conectaBase->query($sentencia);

            // Inserción en la tabla "reserva".
            if ($resultado->num_rows < 1) {
                $sentenciaInsert = "INSERT INTO reserva (`idFranja`, `idLector`) VALUES ('" . $f . "'," . $idUsuario . ")";
                $this->conectaBase->query($sentenciaInsert);
            }
        }

        $this->conectaBase->close();
    }



    // ***************** DEVUELVE ARRAY DE RESERVAS ********************
    public function getReservas($idLector)
    {
        $arrayReservas = array();
        $this->conectarBaseDatos();

        // Primera sentencia para cambiar el idioma de los elementos temporales (nombres de días o meses)
        $idiomaMYSQL = "SET lc_time_names = 'es_ES';";
        $this->conectaBase->query($idiomaMYSQL);

        // Consulta "select" uniendo cuatro tablas de la base de datos para obtener toda la información de cada reserva
        // Formato día semana, fecha completa DATE_FORMAT(`fecha`, '%W %e de %M de %Y')
        $sentencia = "SELECT
        r.`idFranja`, DATE_FORMAT(`fecha`, '%e %M') AS `fecha`, DATE_FORMAT(`horaInicio`, '%H') AS `hora`, `descripcion`, `nomBiblio`, `planta`
        FROM reserva r JOIN franja f ON f.`idFranja` = r.`idFranja`
        JOIN asiento a ON f.`idAsiento` = a.`idAsiento`
        JOIN biblioteca b ON a.`idBiblioteca` = b.`idBiblioteca`
        WHERE r.`idLector` =" . $idLector . ";";

        $resultado = $this->conectaBase->query($sentencia);

        while ($fila = $resultado->fetch_assoc()) {
            array_push(
                $arrayReservas,
                new Franja($fila['idFranja'], $fila['fecha'], $fila['hora'], $fila['descripcion'], $fila['planta'], $fila['nomBiblio'])
            );
        }
        $this->conectaBase->close();
        return $arrayReservas;
    }

    // ***************** DEVUELVE ARRAY DE RESERVAS ********************
    public function proximaReserva($idLector)
    {
        $arrayReservas = array();
        $this->conectarBaseDatos();

        // Primera sentencia para cambiar el idioma de los elementos temporales (nombres de días o meses)
        $idiomaMYSQL = "SET lc_time_names = 'es_ES';";
        $this->conectaBase->query($idiomaMYSQL);

        // Consulta "select" uniendo cuatro tablas de la base de datos para obtener toda la información de cada reserva
        // Formato día semana, fecha completa DATE_FORMAT(`fecha`, '%W %e de %M de %Y')
        $sentencia = "SELECT
        r.`idFranja`, DATE_FORMAT(`fecha`, '%e %M') AS `fecha`, DATE_FORMAT(`horaInicio`, '%H') AS `hora`, `descripcion`, `nomBiblio`, `planta`
        FROM reserva r JOIN franja f ON f.`idFranja` = r.`idFranja`
        JOIN asiento a ON f.`idAsiento` = a.`idAsiento`
        JOIN biblioteca b ON a.`idBiblioteca` = b.`idBiblioteca`
        WHERE r.`idLector` =" . $idLector . " ORDER BY `fecha`, `hora` LIMIT 1;";

        $resultado = $this->conectaBase->query($sentencia);

        if ($resultado->num_rows == 0) {
            return 0;
        } else {

            $fila = $resultado->fetch_assoc();
            $ultimaReserva = new Franja($fila['idFranja'], $fila['fecha'], $fila['hora'], $fila['descripcion'], $fila['planta'], $fila['nomBiblio']);
        }
        /*while ($fila = $resultado->fetch_assoc()) {
            array_push(
                $arrayReservas,
                new Franja($fila['idFranja'], $fila['fecha'], $fila['hora'], $fila['descripcion'], $fila['planta'], $fila['nomBiblio'])
            );
        }*/
        $this->conectaBase->close();
        //return $arrayReservas;
        return $ultimaReserva;
    }


    // *************** DEVUELVE UN OBJETO ASIENTO ******************
    public function datosAsiento($idAsiento)
    {
        $this->conectarBaseDatos();
        $sentencia = "SELECT * FROM asiento WHERE `idAsiento`=" . $idAsiento . ";";
        $resultado = $this->conectaBase->query($sentencia);
        $row = $resultado->fetch_assoc();
        $asiento = new Asiento($row['idAsiento'], $row['planta'], $row['idBiblioteca'], $row['descripcion']);

        $this->conectaBase->close();
        return $asiento;
    }




    // ************ Funciones de CRUD a base de datos ************ //  
    public function insertar($dato1, $dato2, $dato3, $dato4)
    {
        $this->conectarBaseDatos();

        $sentencia = "INSERT INTO " . $this->nombreTabla . " (nomBiblio, direccionBiblio, tlfBiblio, emailBiblio) VALUES ('" . $dato1 . "'," . $dato2 . ",'" . $dato3 . "','" . $dato4 . "')";

        if ($this->conectaBase->query($sentencia)) {
            echo "<p>Registro insertado con éxito</p>";
        } else {
            echo "<p>Hubo un error al ejecutar la sentencia de inserción: {$this->conectaBase->error}</p>";
        }
        $this->conectaBase->close();
    }


    public function obtenerId($campo1)
    {

        $this->conectarBaseDatos();
        $sentencia = "SELECT `idBiblioteca` FROM " . $this->nombreTabla . " WHERE `nomBiblio` = '" . $campo1 . "'";
        $resultado = $this->conectaBase->query($sentencia);

        $lecturaArray = [];
        while ($fila = $resultado->fetch_assoc()) {
            $lecturaArray = $fila;
        }

        $this->conectaBase->close();
        return $lecturaArray['idBiblioteca'];
    }

    public function actualizar($nuevoValor1, $nuevoValor2, $nuevoValor3, $nuevoValor4, $idRegistro)
    {
        $this->conectarBaseDatos();

        $sentencia = "UPDATE " . $this->nombreTabla . " SET `nomBiblio`='" . $nuevoValor1 . "',`direccionBiblio`='" . $nuevoValor2 . "',`tlfBiblio`='" . $nuevoValor3 . "',`emailBiblio`='" . $nuevoValor4 . "' WHERE `idBiblioteca`='" . $idRegistro . "'";

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

        $sentencia = "DELETE FROM " . $this->nombreTabla . " WHERE `idBiblioteca`=" . $idRegistro;

        if ($this->conectaBase->query($sentencia)) {
            echo "<p>Registro eliminado con éxito</p>";
        } else {
            echo "<p>Hubo un error al ejecutar la sentencia de inserción: {$this->conectaBase->error}</p>";
        }
        $this->conectaBase->close();
    }



    // ************ Funciones "getter" y "setter" ************ //
    public function getIdBiblioteca()
    {
        return $this->idBiblioteca;
    }

    public function setIdBiblioteca($num)
    {
        $this->idBiblioteca = $num;
    }

    public function getNomBiblio()
    {
        return $this->nomBiblio;
    }
    public function setNomBiblio($texto)
    {
        $this->nomBiblio = $texto;
    }

    public function getDireccionBiblio()
    {
        return $this->direccionBiblio;
    }
    public function setDireccionBiblio($texto)
    {
        $this->direccionBiblio = $texto;
    }

    public function getTlfBiblio()
    {
        return $this->tlfBiblio;
    }
    public function setTlfBiblio($num)
    {
        $this->tlfBiblio = $num;
    }

    public function getEmailBiblio()
    {
        return $this->emailBiblio;
    }
    public function setEmailBiblio($email)
    {
        $this->emailBiblio = $email;
    }
    public function getImg()
    {
        return $this->img;
    }
    public function getArrayFechas()
    {
        return $this->arrayFechas;
    }

    public function setArrayFechas($array)
    {
        $this->arrayFechas = $array;
    }
    public function getArrayHoras()
    {
        return $this->arrayHoras;
    }

    public function setArrayHoras($array)
    {
        $this->arrayHoras = $array;
    }

    public function getArrayPlantas()
    {
        return $this->arrayPlantas;
    }

    public function setArrayPlantas($array)
    {
        $this->arrayPlantas = $array;
    }

    public function getArrayAsientos()
    {
        return $this->arrayAsientos;
    }

    public function setArrayAsientos($array)
    {
        $this->arrayAsientos = $array;
    }

    public function getArrayFranjas()
    {
        return $this->arrayFranjas;
    }

    public function setArrayFranjas($array)
    {
        $this->arrayFranjas = $array;
    }
}
