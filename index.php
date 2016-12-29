<?php 
session_start();
	if (isset($_SESSION["usuario"])) {
		header("Location: zona-usuarios.php");
	}

	if (isset($_GET["data"])) {
		if ($_GET["data"] == "false") {
			echo "Debe ingresar usuario y contraseña.";
		}
	}

	if (isset($_GET["login"])) {
		if ($_GET["login"] == "false") {
			echo "Usuario y/o contraseña incorrecto.";
		}
	}
 ?>
 <!DOCTYPE html>
 <html lang="eS">
 <head>
 	<meta charset="UTF-8">
 	<title>Login</title>
 </head>
 <body>

 	Login en php

 	<form action="login.php" method="post">
 		<label for="usuario">Usario</label>
 		<input name="usuario" type="text" placeholder="Introduce tu usuario">

		<label for="contraseña">Contraseña</label>
 		<input name="contraseña" type="password" placeholder="Introduce tu contraseña">

 		<button type="submit">Acceder</button>

 	</form>
 	
 </body>
 </html>