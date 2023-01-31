<html>
<body><!-- Creamos unha liña de texto na esquina superior dereita cunha mensaxe de benvida e o usuario en cuestión-->
<p style="color:red;text-align:right;">
<?php
session_start();
echo "Benvido: ".$_SESSION['usuario'];
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
	<input type="submit" value="Aluguer de coches" />
</form>
<br/><br/>
<p><a href="index.html">Pechar sesión</a></p>
</body>
</html>

