<?php
//Conexión inicial coa base de datos "frota"
$db = mysqli_connect("localhost", "root", "", "frota");

//Facemos o request do usuario+contrasinal do index.html e gardamos as query do sql en variables
$usuario = $_REQUEST['usuario'];
$contrasinal = $_REQUEST['palabra_secreta'];
$query_usuario_db = "SELECT `usuario` FROM `usuario` WHERE usuario='$usuario'";
$query_contrasinal_db = "SELECT `contrasinal` FROM `usuario` WHERE usuario='$usuario' AND contrasinal='$contrasinal'";

//Facemos as peticións á database usando as consultas anteriores e gardamos o resultado 
$resultado_usuario = mysqli_query($db, $query_usuario_db);
$resultado_contrasinal = mysqli_query($db, $query_contrasinal_db);
mysqli_close($db);

if ($resultado_usuario->num_rows > 0){ //Comproba se a consulta devolve algunha fila
//En caso afirmativo o usuario existe
	if ($resultado_contrasinal->num_rows > 0){ //Comproba se a consulta devolve algunha fila
	//En caso afirmativo a contrasinal está ben
		session_start();
    		$_SESSION["usuario"] = $usuario;
    		#Logo redireccionamos á páxina secreta (logged.php)
    		header("Location: logged.html");
	}
	
	else{ //Se o usuario existe pero a contrasinal está mal avisamos de que o que falla é a contrasinal
		echo "Contrasinal incorrecta. Volva intentalo";
		?>
		<p><a href="index.html">Volver a inicio</a></p>
		<?php
	}
	
}

else{ //Se non se atopa o usuario na database avisamos de que é necesario rexistrarse ou intentalo con outro usuario
	echo "O usuario non existe. Rexístrese ou inténteo con outro usuario";
	?>
	<p><a href="index.html">Volver a inicio</a></p>
	<p><a href="register.html">Rexístrese gratis</a></p>
	<?php

}
?>
