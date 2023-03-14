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

if ($_SESSION["permisos"] == "A"){//Comprobación dos permisos. Se estes son == A o usuario será redirixido a logged_admin.php
				//(Isto significaría que un usuario admin está intentando entrar poñendo a url manualmente)
	header("Location: logged_admin.php");
}
?>
</p>	
<form name="enVenta" method="post" action="lista_venda.php">
	<input type="submit" value="Vehículos en venda" />
</form>
<br/><br/>
<form name="enAluguer" method="post" action="lista_aluguer.php">
	<input type="submit" value="Vehículos en aluguer"/>
</form>
<br/><br/>
	<form name="modificarPerfil" method="post" action="modif_perfil_web.php">
	<input type="submit" value="Modificación de datos do perfil" />
</form>
<br/><br/>
	<form name="alugar coche" method="post" action="aluguer_coche.php">
	<input type="submit" value="Aluguer de vehículos" />
</form>
<br/><br/>
	<form name="devolver coche" method="post" action="devolucion_coche.php">
	<input type="submit" value="Devolución de vehículos" />
</form>
<br/><br/>
	<form name="mercar vehículo" method="post" action="mercar_coche.php">
	<input type="submit" value="Mercar vehículos" />
</form>
<p><a href="logout.php">Pechar sesión</a></p>
</body>
</html>

