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

if ($_SESSION["permisos"] == "U"){//Comprobación dos permisos. Se estes son == U o usuario será redirixido a logged.php
				//(Isto significaría que un usuario non admin está intentando entrar poñendo a url manualmente)
	header("Location: logged.php");
}
?>
</p>
<body>
<h1>Nova inserción de venda</h1>
<form method="post" action="confirmar_insertar_nova_venda.php" name="nova_venda">
    <div class="form-element">
        <label>Modelo </label>
        <input type="text" name="modelo" />
    </div>
    <p></p>
    <div class="form-element">
        <label>Cantidade </label>
        <input type="text" name="cantidade"/>
    </div>
    <p></p>
    <div class="form-element">
        <label>Descrición </label>
        <input type="text" name="descricion"/>
    </div>
    <p></p>
     <div class="form-element">
        <label>Marca </label>
        <input type="text" name="marca">
    </div>
    <p></p>
    <div class="form-element">
        <label>Prezo </label>
        <input type="text" name="prezo"/>
    </div>
    <p></p>
    <div class="form-element">
        <label>Foto (exemplo: coche.png) </label>
        <input type="text" name="foto"/>
    </div>
    <p></p>
    <button type="submit" name="nova_venda" value="nova_venda">Enviar</button>
</form>
<p>
<a href="logged_admin.php">Volver ao menú de admins</a>
</p>
</body>
</html> 
