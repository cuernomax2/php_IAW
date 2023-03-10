<?php
session_start();

if(!isset($_SESSION["usuario"]) ){ //Se a sesión foi pechada en logout.php o usuario será redirixido ao index
	echo "Sesión expirada, serás redirixido ao index en 3 segundos...";
	header("refresh:3; url=index.php");
    	exit();
}

$db = mysqli_connect("localhost", "root", "", "frota");

$modelo = $_REQUEST['modelo'];
$usuario = $_SESSION['usuario'];








mysqli_close($db);
?> 
