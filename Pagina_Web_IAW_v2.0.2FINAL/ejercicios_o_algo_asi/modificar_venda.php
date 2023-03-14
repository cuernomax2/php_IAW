<?php
session_start();

if(!isset($_SESSION["usuario"]) ){ //Se a sesión foi pechada en logout.php o usuario será redirixido ao index
	echo "Sesión expirada, serás redirixido ao index en 3 segundos...";
	header("refresh:3; url=index.php");
    	exit();
}

if ($_SESSION['permisos'] == "U"){//Comprobación dos permisos. Se estes son == U o usuario será redirixido a logged.php
				//(Isto significaría que un usuario non admin está intentando entrar poñendo a url manualmente)
	header("Location: logged.php");
}
?>
<p style="color:red;text-align:right;">
<?php
echo "Benvido: <b>".$_SESSION['usuario']."</b>";
?>
<!DOCTYPE html>
<html lang='en'>
<body>
  <h2>Modificar vehículos en venda</h2>
  <form name='formulario_vehiculo' method='post' action='confirmar_modificar_venda.php'>
    <p text-align='center'>Modelo 
    <input type='text' name='modelo' value=''></p>
    <p text-align='center'>Cantidade 
    <input type='text' name='cantidade' value=''></p>
    <p text-align='center'>Descricion 
    <input type='text' name='descricion' value=''></p>
    <p text-align='center'>Marca 
    <input type='text' name='marca' value=''></p>
    <p text-align='center'>Prezo 
    <input type='text' name='prezo' value=''></p>
    <p text-align='center'>Foto (exemplo: coche.png) 
    <input type='text' name='foto' value=''>
    <p><input type='submit' name="modif_aluguer"/></p>
  </form>
      <a href="logged_admin.php">Volver ao inicio</a>

</body>
</html> 
