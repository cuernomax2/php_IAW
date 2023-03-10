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

$usuario = $_SESSION['usuario'];
$db = mysqli_connect("localhost","root", "", "frota");
$query_peticion = "SELECT * FROM vehiculo_alugado WHERE usuario='$usuario'";
$resultado = mysqli_query($db, $query_peticion);

echo "<table>";
echo "<tr>";
echo "<th> Usuario_</th>";
echo "<th> _Modelo_</th>";
echo "<th> _Cantidade_</th>";
echo "<th> _Marca</th>";
echo "</tr>";
echo "</table>";

echo '<form name="devolucion" method="post" action="devolucion_parcial.php">';
echo '<label for="modelo"></label>';
echo '<select name="modelo" id="modelo">';

while($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) { //CAMBIAR "RADIO" POR "SELECTOR"
	if($fila['cantidade'] > 0){
		echo "<tr>";
		echo "<option value='".$fila['modelo']."'>".$usuario." | ".$fila['modelo']." | ".$fila['cantidade']." | ".$fila['modelo']."</option>'";
		echo "</tr>";
	}
}
echo '</select>';
echo '<br>';
echo '</br>';
echo '<input type="submit" value="Devolver" /></form>';
echo '<p><a href="logged.php">Volver ao inicio</a></p>';

mysqli_close($db);
?> 
