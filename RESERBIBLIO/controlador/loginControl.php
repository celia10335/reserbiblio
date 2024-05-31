<?php

// Controlador que controla todo lo relativo al registro o inicio de sesión de usuario. Utiliza un modelo auxiliar llamado model, que irá instanciando objetos de las clases "Usuario" y "Lector" según necesite.
class loginControl
{
	public $view;
	public $model;
	public $title;
	public $header;


	public function __construct()
	{
		$this->view = 'login';
		$this->model = new App();
		$this->header = true;
	}

	// *********** PANTALLA POR DEFECTO: LOGIN ***********
	// Por defecto, "index.php" va a llamar a la función "login()". Si existe variable de sesión "idUsuario", carga la vista "Bibliotecas" con la sesión ya iniciada.
	// Si la variable de sesión está vacía, carga la vista "login" donde el usuario puede introducir sus credenciales o crear nuevo usuario.
	// Si se pulsa el botón "Iniciar sesión", el controlador invoca el método "logearUsuario()".
	// Si, por el contrario, se quiere registrar un nuevo usuario, el controlador llamará al método "crear_usuario()".
	public function login()
	{

		if (isset($_SESSION['idUsuario'])) {
			return $this->verBibliotecas();
		} else {
			$this->view = 'login';
			$this->title = 'Inicio de Sesión';
			$this->header = false;
		}
	}


	// *********** PANTALLA "VER BIBLIOTECAS" CON SESIÓN INICIADA ***********
	public function verBibliotecas()
	{
		$this->view = 'bibliotecas';
		$this->title = 'Elige biblioteca';
		$this->model = new Biblioteca();
		return $this->model->leer();
	}


	// *********** SI LA SESIÓN ESTÁ INICIADA VA A "BIBLIOTECAS"; SI NO, DIRIGE A LA PANTALLA DE INICIO DE SESIÓN ***********
	// Cuando se inicia sesión, se guarda el ID en una variable de SESSION, de manera que la sesión queda abierta. Lleva al usuario a la pantalla de "Elegir biblioteca". Si se cerró sesión, la variable de SESSION se vació, se le enviará a la pantalla "login" para volver a iniciar la sesión.
	public function sesionIniciada()
	{

		if (isset($_SESSION['idUsuario'])) {
			return $this->verBibliotecas();
		} else {
			$this->view = 'login';
			$this->title = 'Inicio de Sesión';
		}
	}

	// *************** FUNCIÓN PARA INICIAR SESIÓN *****************
	// El controlador crea una variable "usuarioLector" que devuelve false si el usuario o contraseña no coinciden. Si todo va bien, el controlador cambia de modelo a Biblioteca e invoca el método "leer". Se muestra la vista "Bibliotecas".
	public function logearUsuario()
	{
		$usuarioLector = $this->model->inicioSesion($_POST['contrasenya'], $_POST['email']);
		if ($usuarioLector) {
			return $this->verBibliotecas();
		} else {
			echo "<h1>El usuario o la contraseña son incorrectos</h1>";
			$this->login();
		}
	}


	// *************** FUNCIÓN QUE DIRIGE AL FORMULARIO DE REGISTRO *****************
	// Lleva al usuario al formulario para registrarse.
	public function crear_usuario()
	{
		$this->view = 'nuevoUsuario';
		$this->title = 'Crear usuario';
		$this->header = false;
	}





	// *********** DESDE LA PANTALLA DE REGISTRO DE USUARIO, RECOGE LOS DATOS Y REGISTRA AL NUEVO USUARIO ***********
	// Recibe por $_POST los datos introducidos por el usuario y los envía a la clase "App", que ejecuta una sentencia de inserción en la base de datos (primero en la tabla "Usuario" y después en la tabla "Lector"). Devuelve un objeto "Lector" con los datos registrados. Además, guarda el id en una variable de $_SESSION.
	// Si la inserción es correcta, el controlador llama al método para iniciar sesión "logearUsuario". Si no, lleva a una pantalla con el mensaje "ha habido un error".
	public function guardar_usuario()
	{
		$this->view = 'usuario_insertado';
		$this->title = 'Ha habido un error';

		if ($this->model->guardarUsuario($_POST['email'], $_POST['contrasenya'], $_POST['nombre'], $_POST['apell1'], $_POST['apell2'], $_POST['dni'], $_POST['tlf'], $_POST['direccion'], $_POST['codPostal'], $_POST['numSocio'])) {
			return $this->verBibliotecas();
		} else {
			$this->view = 'usuario_insertado';
			$this->title = 'Ha habido un error';
		}

		//return $this->model->getLectorById($_SESSION['idUsuario']);
	}


	//	*********** PANTALLA DE OLVIDO DE CONTRASEÑA ***********
	public function olvido()
	{
		$this->view = 'olvido';
	}


	// *********** CIERRA LA SESIÓN ***********
	// Llama al método "close" de la clase "App". Ésta vaciará la variable de $_SESSION con el idUsuario. Redirige a "Bibliotecas" pero pedirá los datos para iniciar sesión de nuevo.
	public function cerrarSesion()
	{
		$this->model->close();
		$this->login();
	}


	// *********** PANTALLA "VER DATOS DE USUARIO" ***********
	public function perfilUsuario()
	{
		$this->view = 'datosUsuario';
		$this->title = "Mi perfil";
		return $this->model->getLectorById($_SESSION["idUsuario"]);
	}


	// *********** PANTALLA CON FORMULARIO PARA MODIFICAR DATOS DE USUARIO ***********
	// Lleva a la página "Editar usuario", que muestra un formulario con los datos personales (algunos, como el idUsuario o el numSocio, ocultos, porque no se pueden modificar).
	public function editarLector()
	{
		$this->view = 'editarUsuario';
		$this->title = "Editar usuario";
		return $this->model->getLectorById($_SESSION["idUsuario"]);
	}


	// *********** MODIFICAR DATOS DE USUARIO ***********
	public function guardarEdicionLector()
	{
		$this->view = 'usuarioEditado';

		// Los datos de email y contraseña se pasan con valores nulos porque no se pueden modificar desde la vista "editarUsuario".
		$this->model = new Usuario($_SESSION['idUsuario'], null, null, $_POST['nombre'], $_POST['apell1'], $_POST['apell2'], $_POST['dni'], $_POST['tlf'], $_POST['direccion'], $_POST['codPostal']);

		return $this->model->guardarEdicion();
	}


	// ************** ELIMINAR USUARIO ****************
	public function solicitudBorrado()
	{
		$this->view = 'confirmarBorrado';
	}


	public function eliminarUsuario()
	{
		$this->view = 'index';
		$this->model = new Usuario();
		return $this->model->eliminar($_SESSION['idUsuario']);
	}



	public function crearQr()
	{
		$this->view = 'qr';
	}
}
