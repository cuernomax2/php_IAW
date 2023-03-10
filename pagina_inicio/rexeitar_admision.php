<?php
session_start();

if(!isset($_SESSION["usuario"]) ){ //Se a sesión foi pechada en logout.php o usuario será redirixido ao index
	echo "Sesión expirada, serás redirixido ao index en 3 segundos...";
	header("refresh:3; url=index.php");
    	exit();
}

if ($_SESSION['permisos'] == "U"){//Comprobación dos permisos. Se estes son == U o usuario será redirixido a logged.php
				//(Isto significaría que un usuario admin está intentando entrar poñendo a url manualmente)
	header("Location: logged.php");
}

$db = mysqli_connect("localhost", "root", "", "frota");

$query_peticion = "SELECT * FROM novo_rexistro";
$resultado = mysqli_query($db, $query_peticion);

while($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)){

$query_delete = sprintf("DELETE FROM novo_rexistro WHERE usuario='%s'", $fila['usuario']);

	mysqli_query($db, $query_delete);
	
}

mysqli_close($db);
echo "Rexeitación completada, serás redirixido ao menú de admins en 3 segundos...";
header("refresh:3; url=logged_admin.php");
?>  
