<?php
require_once 'usuarioModel.php';

class Bibliotecario extends Usuario
{
    private $rol;

    public function __construct($dato1, $dato2, $dato3, $dato4, $dato5, $dato6, $dato7, $dato8, $dato9, $dato10)
    {
        parent::__construct($dato1, $dato2, $dato3, $dato4, $dato5, $dato6, $dato7, $dato8, $dato9, $dato10);
        $this->rol;
    }

    public function getRol()
    {
        return $this->rol;
    }

    public function setRol($num)
    {
        $this->rol = $num;
    }
}
