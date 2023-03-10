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
if ($_SESSION['permisos'] == "U"){//Comprobación dos permisos. Se estes son == 1 o usuario será redirixido a logged_admin.php
				//(Isto significaría que un usuario admin está intentando entrar poñendo a url manualmente)
	header("Location: logged.php");
}
?>
</p>
</body>
</html>
<?php
$db = mysqli_connect("localhost", "root", "", "frota");
$query_peticion = "SELECT * FROM vehiculo_venda";
$resultado = mysqli_query($db, $query_peticion);

echo "<table>";
echo "<tr>";
echo "<th> Modelo___</th>";
echo "<th> ___Cantidade___ </th>";
echo "<th> ___Descrición___  </th>";
echo "<th> ___Marca___  </th>";
echo "<th> ___Prezo___  </th>";
echo "<th> ___Foto  </th>";
echo "</tr>";

echo '<form name="devolucion" method="post" action="confirmar_eliminar_venda.php">';

while($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
	echo "<tr>";
	echo "<td> " . $fila['modelo'] . "</td>";
	echo "<td> " . $fila['cantidade'] . "</td>";
	echo "<td> " . $fila['descricion'] . "</td>";
	echo "<td> " . $fila['marca'] . "</td>";
	echo "<td> " . $fila['prezo'] . "</td>";
	echo "<td> " . $fila['foto'] . "</td>";
	echo "<td> <input type='radio' name='modelo' value='".$fila['modelo']."'/> Eliminar ".$fila['modelo']."</td>";
	echo "</tr>";
}
echo "</table>";
echo "<br>";
echo '<input type="submit" value="Eliminar selección" /></form>';
echo '<br/>';
echo '<p><a href="logged.php">Volver ao inicio</a></p>';

echo "<br>"; 
echo "<br>"; 

mysqli_close($db);
?> 
