<?php
//Conexión inicial coa base de datos "frota"
$db = mysqli_connect("localhost", "root", "", "frota");

//Facemos o request do usuario+contrasinal do index.html e gardamos as query do sql en variables
$usuario = $_REQUEST['usuario'];
$contrasinal = $_REQUEST['palabra_secreta'];

$query_usuario_db = "SELECT `usuario` FROM `usuario` WHERE usuario='$usuario'";//Usuario da DB usuario
$query_usuario_novo_rexistro_db = "SELECT `usuario` FROM `novo_rexistro` WHERE usuario='$usuario'"; //Usuario da DB novo_rexistro
$query_contrasinal_db = "SELECT `contrasinal` FROM `usuario` WHERE usuario='$usuario' AND contrasinal='$contrasinal'"; //Usuario + contrasinal da DB usuario
$query_admin_db = "SELECT `tipo_usuario` FROM `usuario` WHERE usuario='$usuario' AND contrasinal='$contrasinal' AND tipo_usuario='A'"; //Usuario + contrasinal + tipo_usuario da DB usuario

//Facemos as peticións á database usando as consultas anteriores e gardamos o resultado 
$resultado_usuario = mysqli_query($db, $query_usuario_db);//Query do usuario da DB usuario
$resultado_usuario_novo_rexistro = mysqli_query($db, $query_usuario_novo_rexistro_db); //Query do usuario da DB novo_rexistro
$resultado_contrasinal = mysqli_query($db, $query_contrasinal_db);//Query do usuario + contrasinal da DB usuario
$resultado_admin = mysqli_query($db, $query_admin_db);//Query do usuario + contrasinal + tipo_usuario da DB usuario
mysqli_close($db);

if ($resultado_usuario->num_rows > 0){ //Comproba se a consulta devolve algunha fila
//En caso afirmativo o usuario existe
	if ($resultado_admin->num_rows > 0){//Se coinciden os tres parámetros de $query_admin_db o usuario é administrador
		session_start();
	    	$_SESSION['usuario'] = $usuario;
	    	$_SESSION['permisos'] = "A";
	    	#Logo redireccionamos á páxina main(que logo con "permisos"=1 redireccionará a logged_admin.php)
	    	header("Location: logged.php");
	}
	
	elseif ($resultado_contrasinal->num_rows > 0){ //Se coinciden os dous parámetros de $query_contrasinal_db o usuario+contrasinal
	//están ben pero o usuario non é administrador
	//En caso afirmativo a contrasinal está ben
		session_start();
    		$_SESSION['usuario'] = $usuario;
    		$_SESSION['permisos'] = "U";
    		#Logo redireccionamos á páxina main(logged.php)
    		header("Location: logged.php");
	}
	
	else{ //Se o usuario existe pero a contrasinal está mal avisamos de que o que falla é a contrasinal
		echo "Contrasinal incorrecta. Volva intentalo";
		?>
		<p><a href="index.php">Volver ao inicio</a></p>
		<?php
	}
}

elseif ($resultado_usuario_novo_rexistro->num_rows > 0){ //Se o usuario existe na DB novo_rexistro pero está pendente de validación
	echo "Usuario pendente de validación. Por favor seleccione outro usuario ou espere a ser validado";
	?>
	<p><a href="index.php">Volver ao inicio</a></p>
	<?php
}
	
else{ //Se non se atopa o usuario na database avisamos de que é necesario rexistrarse ou intentalo con outro usuario
	echo "O usuario non existe. Rexístrese ou inténteo con outro usuario";
	?>
	<p><a href="index.php">Volver a inicio</a></p>
	<p><a href="register.html">Rexístrese gratis</a></p>
	<?php

}
?>
