<?php 
	session_start();

	if (isset($_SESSION["usuario"])) {
		header("Location: zona-usuarios.php");		
	}

	if ( isset($_POST["usuario"]) && isset($_POST["contraseña"]) && isset($_POST["c_contraseña"])  ) {
		  $usuario = $_POST["usuario"];
		  $usuario = strip_tags($usuario);
		  $usuario = stripslashes($usuario);
		  $usuario = filter_var($usuario, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES); 

		  $contraseña = $_POST["contraseña"];
		  $contraseña = strip_tags($contraseña);
		  $contraseña = stripslashes($contraseña);
		  $contraseña = filter_var($contraseña, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES); 

		  $c_contraseña = $_POST["c_contraseña"];
		  $c_contraseña = strip_tags($c_contraseña);
		  $c_contraseña = stripslashes($c_contraseña);
		  $c_contraseña = filter_var($c_contraseña, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES); 

		  if ( strlen($usuario)<4 || strlen($usuario>25) ) {
		  		echo "El usuario debe tener de 4 a 25 caracteres de longitud";
		  }

		  if ( strlen($contraseña)<6 || strlen($contraseña)>30  ) {
		  		echo "La contraseña debe tener de 6 a 30 caracteres de longitud";
		  }

		  if ($contraseña != $c_contraseña) {
		  		echo "Las contraseñas no coinciden";
		  } else {
		  		try {
		  			$contraseña = password_hash($contraseña, PASSWORD_DEFAULT); 	

		  			require_once("DB.php");
					$DB = new DB();

					$insertar = $DB->prepare("insert into login(usuario, contraseña) values(:u, :c) ");
					$insertar->bindParam(":u", $usuario);
					$insertar->bindParam(":c", $contraseña);
					$insertar->execute();

					if ($insertar->errorInfo()[2]) {
						echo "El nombre de usuario ya existe.";
					} else {
						header("Location: index.php");
					}					

		  		} catch (Exception $e) {
		  			echo $e->getMessage();
		  		}
		  }


	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Registrar</title>
</head>
<body>

	<h3>Crear cuenta</h3>

	<form method="post">
		<label for="usuario">Nombre de usuario</label>		
		<input type="text" name="usuario" placeholder="Introduce tu usuario " required pattern="[A-Za-zñÑ0-9]{4,25}">

		<label for="contraseña">Contraseña</label>
		<input type="password" name="contraseña" placeholder="Introduce tu contraseña " required pattern="[A-Za-zñÑ0-9]{6,30}">

		<input type="password" name="c_contraseña" placeholder="Confirma tu contraseña" required pattern="[A-Za-zñÑ0-9]{6,30}">

		<button type="submit">Crear cuenta</button>

	</form>
	

</body>
</html>