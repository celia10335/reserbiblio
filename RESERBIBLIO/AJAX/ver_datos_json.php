<?php

require_once '../modelo/bibliotecaModel.php';
require_once '../modelo/dbModel.php';
require_once '../config/config.php';

$biblio = new Biblioteca();
$infoCartela = $biblio->datosBiblioJson($_GET['idBiblioteca']);


echo json_encode($infoCartela);
