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

$query_select_devolto = "SELECT * FROM `vehiculo_devolto`";
$resultado_devolto = mysqli_query($db, $query_select_devolto);

while($fila_devolto = mysqli_fetch_array($resultado_devolto, MYSQLI_ASSOC)){
	$cantidade_devolto = $fila_devolto['cantidade'];
	$modelo = $fila_devolto['modelo'];
		
	$query_update_aluguer = "UPDATE `vehiculo_aluguer` SET cantidade=cantidade + '$cantidade_devolto' WHERE modelo='$modelo'";

	mysqli_query($db, $query_update_aluguer);
}

$query_delete_alugado = "DELETE FROM `vehiculo_devolto`";
mysqli_query($db, $query_delete_alugado);

mysqli_close($db);
echo "Devolución(s) completada(s), serás redirixido ao menú de admins en 3 segundos...";
header("refresh:3; url=logged_admin.php");
?> 
