<?php 
	
	session_start();
	
	if (!isset($_SESSION["usuario"])) {
		header("Location: index.php");
	}

 ?>
 <!DOCTYPE html>
 <html lang="es">
 <head>
 	<meta charset="UTF-8">
 	<title>Inicio</title>
 </head>
 <body>
 	<?php echo "Bienvenido " . $_SESSION["usuario"]["usuario"] ; ?>
 	<a href="logout.php">Cerrar sesión</a>
 </body>
 </html>