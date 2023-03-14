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
$query_peticion = "SELECT * FROM novo_rexistro";
$resultado = mysqli_query($db, $query_peticion);

echo "<table>";
echo "<tr>";
echo "<th> Usuario___</th>";
echo "<th> ___Contrasinal___ </th>";
echo "<th> ___Nome___  </th>";
echo "<th> ___Dirección___  </th>";
echo "<th> ___Teléfono___  </th>";
echo "<th> ___NifDNI___  </th>";
echo "<th> ___Email  </th>";
echo "</tr>";

while($fila = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
	echo "<tr>";
	echo "<td> " . $fila['usuario'] . "</td>";
	echo "<td> " . $fila['contrasinal'] . "</td>";
	echo "<td> " . $fila['nome'] . "</td>";
	echo "<td> " . $fila['direccion'] . "</td>";
	echo "<td> " . $fila['telefono'] . "</td>";
	echo "<td> " . $fila['nifdni'] . "</td>";
	echo "<td> " . $fila['email'] . "</td>";
	echo "</tr>";
	
}
echo "</table>";
echo "<br>";
?>
<form method="post" action="aplicar_admision.php" name="Admision">
    <div class="form-element">
        <input type="submit" value="Admitir todos os usuarios" />
    </div>
</form>
<br>
<form method="post" action="rexeitar_admision.php" name="Rexeitacion">
    <div class="form-element">
        <input type="submit" value="Rexeitar todos os usuarios" />
    </div>
</form>
<p>
<a href="logged.php">Volver ao inicio</a>
</p>
<?php
echo "<br>"; 
echo "<br>"; 

mysqli_close($db);
?>
