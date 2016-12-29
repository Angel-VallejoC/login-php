<?php 	

	if ( isset($_POST["usuario"]) && isset($_POST["contraseña"]) ) {
		try {

			require_once("DB.php");
			$DB = new DB();

			$usuario = $_POST["usuario"];
			$usuario = strip_tags($usuario);
			$usuario = stripslashes($usuario);
			$usuario = filter_var($usuario, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES); 

			$contraseña = $_POST["contraseña"];
			$contraseña = strip_tags($contraseña);
			$contraseña = stripslashes($contraseña);
			$contraseña = filter_var($contraseña, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES); 

			$consulta = $DB->prepare("select * from login where usuario = :u and contraseña = :c ");
			$consulta->bindParam(":u", $usuario);
			$consulta->bindParam(":c", $contraseña);
			$consulta->execute();
			$consulta = $consulta->Fetch(PDO::FETCH_ASSOC);

			if ($consulta) {
				session_start();
				$_SESSION["usuario"] = $consulta;
				header("Location: zona-usuarios.php");
			} else {
				header("Location: index.php?login=false");
			}


		} catch (Exception $e) {
			echo "ERROR: " . $e->getMessage();
		}
	} else {
		header("Location: index.php?data=false");
	}



?>