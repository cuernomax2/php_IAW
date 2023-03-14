<?php
session_start();

if(!isset($_SESSION["usuario"]) ){ //Se a sesión foi pechada en logout.php o usuario será redirixido ao index
	echo "Sesión expirada, serás redirixido ao index en 3 segundos...";
	header("refresh:3; url=index.php");
    	exit();
}
?>
<html>
<body><!-- Creamos unha liña de texto na esquina superior dereita cunha mensaxe de benvida e o usuario en cuestión-->
<p style="color:red;text-align:right;">
<?php
echo "Benvido: <b>".$_SESSION['usuario']."</b>";
?>
</p>
<?php
$db = mysqli_connect("localhost", "root", "", "frota");

$query_peticion = "SELECT * FROM vehiculo_aluguer";
$resultado = mysqli_query($db, $query_peticion);

while($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
	if($fila['cantidade'] > 0){
		echo "Modelo: ".$fila['modelo']."<br/>";
		echo "Cantidade: ".$fila['cantidade']."<br/>";
		echo "Descrición: ".$fila['descricion']."<br/>";
		echo "Marca: ".$fila['marca']."<br/>";
		echo "Prezo: ".$fila['prezo']."<br/>";
		echo $fila['foto']."<br/>";
		echo "<br/>";
	}
}

mysqli_close($db);

echo '<a href="logged.php">Volver</a>';
?>
