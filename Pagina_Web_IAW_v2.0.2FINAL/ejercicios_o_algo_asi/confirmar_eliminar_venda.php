<?php
session_start();

if(!isset($_SESSION["usuario"]) ){ //Se a sesión foi pechada en logout.php o usuario será redirixido ao index
	echo "Sesión expirada, serás redirixido ao index en 3 segundos...";
	header("refresh:3; url=index.php");
    	exit();
}

$db = mysqli_connect("localhost","root", "", "frota"); //Conexión coa base de datos.
$modelo = $_REQUEST['modelo']; //Gardamos o codigo nunha variable 

$query_delete_venda = "DELETE FROM `vehiculo_venda` WHERE modelo='$modelo'";

mysqli_query($db, $query_delete_venda);//Query que borra o vehículo seleccionado da táboa vehiculo_venda

echo "Eliminación completada.<br>";
echo "Redirixindo ao menú principal en 3 segundos...";
header("refresh:3; url=logged.php");

mysqli_close($db);
?>
