<?php
session_start();

if(!isset($_SESSION["usuario"]) ){ //Se a sesión foi pechada en logout.php o usuario será redirixido ao index
	echo "Sesión expirada, serás redirixido ao index en 3 segundos...";
	header("refresh:3; url=index.php");
    	exit();
}

$db = mysqli_connect("localhost","root", "", "frota"); //Conexión coa base de datos.
$usuario = $_SESSION['usuario']; //Gardamos o usuario nunha variable
$modelo = $_REQUEST['modelo']; //Gardamos o código do coche seleccionado nunha variable 

$query_select_alugado = "SELECT * FROM vehiculo_alugado WHERE modelo='$modelo' AND usuario='$usuario'";
$resultado = mysqli_query($db, $query_select_alugado);
$fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC); //Obtemos todos os datos da táboa vehículo_alugado nunha variable

$cantidade_alugado = $fila['cantidade']; //Creo unha variable que almacene a cantidade de coches alugables

if($cantidade_alugado > 0){
	$cantidade_alugado = $cantidade_alugado - 1; //Resta 1 dos vehículos alugados
	$query_update_alugado = "UPDATE vehiculo_alugado SET cantidade='$cantidade_alugado' WHERE modelo='$modelo' AND usuario='$usuario'";
	$query_delete_alugado = "DELETE FROM `vehiculo_alugado` WHERE usuario='$usuario' AND modelo='$modelo'";
	
	if($cantidade_alugado == 0){ //Se despois de devolver o coche a cantidade === 0 elimina a fila da táboa vehiculo_alugado
		mysqli_query($db, $query_delete_alugado); 
	}
	
	else{
		mysqli_query($db, $query_update_alugado); //Actualiza a táboa vehículo_alugado
	}
	
	$query_select_devolto = "SELECT * FROM `vehiculo_devolto` WHERE modelo='$modelo' AND usuario='$usuario'";
	$resultado = mysqli_query($db, $query_select_devolto);
	$fila_devolto = mysqli_fetch_array($resultado, MYSQLI_ASSOC); //Obtemos todos os datos da táboa vehículo_aluguer nunha variable	
	$cantidade_devolto = $fila_devolto['cantidade'];
		
	$query_insert_devolto = sprintf("INSERT INTO `vehiculo_devolto` VALUES ('$modelo','1','%s','%s','%s','$usuario')",  $fila['descricion'], $fila['marca'], $fila['foto']);
	$resultado = mysqli_query($db, $query_select_devolto);
	
	if($resultado->num_rows > 0){
		$cantidade_devolto = $cantidade_devolto + 1;
		$query_update_devolto = "UPDATE vehiculo_devolto SET cantidade='$cantidade_devolto' WHERE modelo='$modelo' AND usuario='$usuario'";
		mysqli_query($db, $query_update_devolto);	
	}
	
	elseif($resultado->num_rows < 1){
		mysqli_query($db, $query_insert_devolto);
	}

	echo "Grazas por devolver un ".$modelo.".<br>"; //Remata e manda o usuario ao menú
	echo "Por favor espere a que un admin valide a súa devolución.<br>";
	echo "Redirixindo ao menú principal en 3 segundos...";
	header("refresh:3; url=logged.php");
}

else{
	echo "Por favor, seleccione un vehículo para devolver.<br>Redirixindo ao menú principal en 3 segundos...";
	header("refresh:3; url=logged.php");
}

mysqli_close($db);
?> 
