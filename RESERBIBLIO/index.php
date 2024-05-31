<?php
// ************ Importar archivos ************
require_once 'config/config.php';
require_once 'modelo/dbModel.php';
require_once 'modelo/appModel.php';
require_once 'modelo/usuarioModel.php';
require_once 'modelo/lectorModel.php';
require_once 'modelo/asientoModel.php';
require_once 'modelo/bibliotecaModel.php';
require_once 'modelo/franjaModel.php';
require_once 'controlador/loginControl.php';
require_once 'controlador/bibliotecaControl.php';
require_once './formateo_fechas.php';
require_once './fechasToString.php';

session_start();

// ************ Parámetros por defecto de "vista" y "controlador" ************
if (!isset($_GET["action"])) $_GET["action"] = constant("DEFAULT_ACTION");
if (!isset($_GET["controller"])) $_GET["controller"] = constant("DEFAULT_CONTROLLER");


$controlador = new $_GET["controller"];
$dataToView = array();
$dataToView  = $controlador->{$_GET["action"]}();

// ************ Importar plantillas y vistas en función del controlador elegido ************
require_once 'plantillas/HTML_head.php';
require_once 'vista/' . $controlador->view . '.php';
require_once 'plantillas/footer.php';
