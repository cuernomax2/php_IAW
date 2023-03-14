<?php
session_start();

if(!isset($_SESSION["usuario"]) ){ //Se a sesión foi pechada en logout.php o usuario será redirixido ao index
	echo "Sesión expirada, serás redirixido ao index en 3 segundos...";
	header("refresh:3; url=index.php");
    	exit();
}

$db = mysqli_connect("localhost","root", "", "frota"); //Conexión coa base de datos.

$modelo = $_REQUEST['modelo']; 
$usuario = $_REQUEST['usuario'];

$query_select_devolto = "SELECT * FROM vehiculo_devolto WHERE modelo='$modelo' AND usuario='$usuario'";
$resultado = mysqli_query($db, $query_select_devolto);
$fila_devolto = mysqli_fetch_array($resultado, MYSQLI_ASSOC); //Obtemos todos os datos da táboa vehículo_alugado nunha variable

$cantidade_devolto = $fila_devolto['cantidade']; //Creo unha variable que almacene a cantidade de coches alugados

if($cantidade_devolto > 0){
	
	$cantidade_devolto = $cantidade_devolto - 1; //Resta 1 dos vehículos devoltos
	
	//$query_select_alugado = "SELECT * FROM vehiculo_alugado WHERE modelo='$modelo' AND usuario='$usuario'";
	//$resultado = mysqli_query($db, $query_select_alugado);
	//$fila_alugado = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
	
	if($cantidade_devolto === 0){ //Se despois de devolver o coche a cantidade === 0 elimina a fila da táboa vehiculo_devolto
		$query_delete_devolto = "DELETE FROM `vehiculo_devolto` WHERE usuario='$usuario' AND modelo='$modelo'";
		mysqli_query($db, $query_delete_devolto); 
	}
	
	else{	
		$query_update_devolto = "UPDATE vehiculo_devolto SET cantidade='$cantidade_devolto' WHERE modelo='$modelo' AND usuario='$usuario'";
		mysqli_query($db, $query_update_devolto); //Actualiza a táboa vehículo_alugado
	}
	
	$query_select_aluguer = "SELECT * FROM vehiculo_aluguer WHERE modelo='$modelo'";
	$resultado = mysqli_query($db, $query_select_aluguer);
	$fila_aluguer = mysqli_fetch_array($resultado, MYSQLI_ASSOC); //Obtemos todos os datos da táboa vehículo_aluguer nunha variable	
	
	$cantidade_aluguer = $fila_aluguer['cantidade'];
	
	if($cantidade_aluguer > 0){
		$cantidade_aluguer = $cantidade_aluguer + 1;
		$query_update_aluguer = "UPDATE vehiculo_aluguer SET cantidade='$cantidade_aluguer' WHERE modelo='$modelo'";
		mysqli_query($db, $query_update_aluguer);
	}
	
	else{ //En caso de que non exista a fila do vehículo en aluguer na táboa crea unha nova co prezo por defecto de 999999
		$query_insert_aluguer = sprintf("INSERT INTO `vehiculo_aluguer` VALUES ('$modelo', '1', '%s','%s','999999','%s')", $fila_devolto['descricion'], $fila_devolto['marca'], $fila_devolto['foto']);
		mysqli_query($db, $query_insert_aluguer);	
	}
	
	echo "Confirmada a devolución dun ".$modelo." do usuario ".$usuario.".<br>"; //Remata e manda o usuario ao menú
	echo "Redirixindo ao menú principal en 3 segundos...";
	header("refresh:3; url=logged.php");
	
}

else{
	echo "Non foi posible devolver o vehículo (a cantidade dispoñible é de 0).<br>Redirixindo ao menú principal en 3 segundos...";
	header("refresh:3; url=logged_admin.php");
}

mysqli_close($db);
?>
