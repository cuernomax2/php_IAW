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
	<form name="devolver coche" method="post" action="devolucion_coche_admin.php">
	<input type="submit" value="Confirmar devolucións (admin)" />
</form>
<br/><br/>
	<form name="admitir usuarios" method="post" action="admision_novo_rexistro.php">
	<input type="submit" value="Admisión de usuarios (admin)" />
</form>
<br/><br/>
	<form name="insertar venda" method="post" action="insertar_nova_venda.php">
	<input type="submit" value="Insertar novos vehículos en venda (admin)" />
</form>
<br/><br/>
	<form name="insertar aluguer" method="post" action="insertar_novo_aluguer.php">
	<input type="submit" value="Insertar novos vehículos de aluguer (admin)" />
</form>
<br/><br/>
	<form name="eliminar venda" method="post" action="eliminar_venda.php">
	<input type="submit" value="Eliminar vehículos en venda (admin)" />
</form>
<br/><br/>
	<form name="eliminar aluguer" method="post" action="eliminar_aluguer.php">
	<input type="submit" value="Eliminar vehículos en aluguer (admin)" />
</form>
<br/><br/>
	<form name="eliminar venda" method="post" action="modificar_venda.php">
	<input type="submit" value="Modificar vehículos en venda (admin)" />
</form>
<br/><br/>
	<form name="eliminar aluguer" method="post" action="modificar_aluguer.php">
	<input type="submit" value="Modificar vehículos en aluguer (admin)" />
</form>
<br/><br/>
	<form name="informe venda" method="post" action="informe_venda.php">
	<input type="submit" value="Informe de vehículos en venda (admin)" />
</form>
<br/><br/>
	<form name="informe aluguer" method="post" action="informe_aluguer.php">
	<input type="submit" value="Informe de vehículos en aluguer (admin)" />
</form>
<p><a href="logout.php">Pechar sesión</a></p>
</body>
</html>
 
