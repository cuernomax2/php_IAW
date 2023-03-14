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

$query_select_aluguer = "SELECT * FROM vehiculo_aluguer WHERE modelo='$modelo'";
$resultado = mysqli_query($db, $query_select_aluguer);
$fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC); //Obtemos todos os datos da táboa vehículo_aluguer nunha variable

$cantidade_aluguer = $fila['cantidade']; //Creo unha variable que almacene a cantidade de coches alugables

if($cantidade_aluguer > 0){ //Se os coches alugables son > 0 procede
	$cantidade_aluguer--; //Resta 1 dos vehículos alugables
	$query_update_aluguer = "UPDATE vehiculo_aluguer SET cantidade='$cantidade_aluguer' WHERE modelo='$modelo'"; 
	mysqli_query($db, $query_update_aluguer); //E actualiza a táboa vehículo_aluguer

	$query_select_alugado = "SELECT * FROM `vehiculo_alugado` WHERE modelo='$modelo' AND usuario='$usuario'";	
	
	if((mysqli_query($db, $query_select_alugado))->num_rows < 1){ //Comproba se existe o coche na táboa vehículo_alugado. En caso negativo crea unha nova entrada co usuario e o código do coche
		$query_insert_alugado = sprintf("INSERT INTO `vehiculo_alugado` VALUES ('$modelo','1','%s','%s','%s', '$usuario')", $fila['descricion'], $fila['marca'], $fila['foto']);
		mysqli_query($db, $query_insert_alugado);
		echo "Grazas por alugar un ".$modelo.".<br>";
		echo "Redirixindo ao menú principal en 3 segundos...";
		header("refresh:3; url=logged.php");
	}

	elseif((mysqli_query($db, $query_select_alugado))->num_rows > 0){ //Se xa existe unha coincidencia procede a facer o update
		$query_cantidade_alugado = "SELECT * FROM vehiculo_alugado WHERE modelo='$modelo' AND usuario='$usuario'";
		$resultado = mysqli_query($db, $query_cantidade_alugado);
		$fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC);
		
		$cantidade_alugado = $fila['cantidade'] + 1;
		
		$query_update_alugado = "UPDATE `vehiculo_alugado` SET cantidade='$cantidade_alugado' WHERE modelo='$modelo' AND usuario='$usuario'";
		mysqli_query($db, $query_update_alugado);
		
		echo "Grazas por alugar un ".$modelo.".<br>"; //Remata e manda o usuario ao menú
		echo "Redirixindo ao menú principal en 3 segundos...";
		header("refresh:3; url=logged.php");
	}
}

else{ //Se non hai suficientes coches alugables salta erro
	echo "Non foi posible alugar o vehículo (a cantidade dispoñible é de 0).<br>Redirixindo ao menú principal en 3 segundos...";
	header("refresh:3; url=logged.php");
}

mysqli_close($db);
?>
