<?php
session_start();

if(!isset($_SESSION['usuario']) ){ //Se a sesión foi pechada en logout.php o usuario será redirixido ao index
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
if ($_SESSION['permisos'] == "U"){//Comprobación dos permisos. Se estes son == U o usuario será redirixido a logged.php
				//(Isto significaría que un usuario non admin está intentando entrar poñendo a url manualmente)
	header("Location: logged.php");
}
?>
</p>
</body>
</html>
<?php

$db = mysqli_connect("localhost", "root", "", "frota");
$query_peticion = "SELECT * FROM vehiculo_devolto";
$resultado = mysqli_query($db, $query_peticion);

echo "<table>";
echo "<tr>";
echo "<th> Usuario___</th>";
echo "<th> ___Modelo___ </th>";
echo "<th> ___Cantidade___  </th>";
echo "<th> ___Marca___  </th>";
echo "</tr>";

while($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
	echo "<tr>";
	echo "<td> " . $fila['usuario'] . "</td>";
	echo "<td> " . $fila['modelo'] . "</td>";
	echo "<td> " . $fila['cantidade'] . "</td>";
	echo "<td> " . $fila['marca'] . "</td>";
	echo "</tr>"; 
}
echo "</table>";
echo "<br>";

mysqli_close($db);

?>
<form method="post" action="confirmar_devolucion.php" name="Admision">
    <div class="form-element">
        <input type="submit" value="Admitir todas as devolucións" />
    </div>
</form>
<p><a href="logged_admin.php">Volver ao inicio</a></p>

