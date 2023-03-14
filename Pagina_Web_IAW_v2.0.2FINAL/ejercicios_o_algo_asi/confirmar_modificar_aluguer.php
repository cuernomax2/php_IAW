<?php
// iniciamos as variables do programa
$modelo = $_REQUEST['modelo'];
$cantidade = $_REQUEST['cantidade'];
$descricion = $_REQUEST['descricion'];
$marca = $_REQUEST['marca'];
$prezo = $_REQUEST['prezo'];
$foto = $_REQUEST['foto'];
$foto_SQL = '<img src="/ejercicios_o_algo_asi/fotos_concesionario/'.$foto.'" height="180" width="300">';
$erros = array();//Array que recollerá todos os erros no rexistro
$contador = 0;//Variable contador que servirá tamén para comprobar se facer a inserción ou non

//Conectarse á base de datos
$db = mysqli_connect("localhost", "root", "", "frota");

//Rexistro dun novo usuario
  //Mecanismo de validación do formulario de rexistro. Asegurámonos de que todos os datos están enchidos e dentro dos límites
if (strlen($modelo) > 80){ 
  $erros[$contador] = "O modelo é demasiado longo (80 caracteres máximo)"; 
  $contador++;
}
  
if (strlen($descricion) > 120){ 
  $erros[$contador] = "A descrición é demasiado longa (120 caracteres máximo)"; 
  $contador++;
} 
  
if (strlen($marca) > 24){ 
  $erros[$contador] = "A marca é demasiado longa (24 caracteres máximo)"; 
  $contador++;
}
  
if (strlen($foto) > 1000){ 
  $erros[$contador] = "A foto é demasiado longa (1000 caracteres máximo)"; 
  $contador++;
}
  
  //Primeiro debemos comprobar a base de datos para saber 
  //se existe ou non un coche co modelo repetido (tabla vehiculo_aluguer)
$modelo_aluguer_query = "SELECT modelo FROM `vehiculo_aluguer` WHERE modelo='$modelo'";
$resultado = mysqli_query($db, $modelo_aluguer_query);
  //Gárdase o resultado da query en $resultado e compróbase
  //o número de filas. Se este é menor que 1 salta erro (o modelo non existe na táboa vehiculo_aluguer)
if (($fila = mysqli_num_rows($resultado)) < 1){
  $erros[$contador] = "Erro: o modelo deste vehículo non está rexistrado na base de datos";
  $contador++;
}

if($contador != 0){//Creamos un if/else que comprobe se a variable $contador está a 0 ou non
//En caso de que contador != 0 significa que houbo erros no rexistro e cun foreach procedemos
//a mostralos todos por pantalla
  foreach ($erros as $valor){
    echo $valor."";
    echo "<br>";
  }
    mysqli_close($db);
  ?>
  <p><a href="modificar_aluguer.php">Volver ao formulario de modificación de aluguer</a></p>
  <p><a href="logged_admin.php">Volver ao menú de admins</a></p>
  <?php
}

else{
  if($cantidade != ""){
    $query = "UPDATE vehiculo_aluguer SET cantidade='$cantidade' WHERE `modelo`='$modelo'";
    mysqli_query($db, $query);
  }

  if($descricion != ""){
    $query = "UPDATE vehiculo_aluguer SET descricion='$descricion' WHERE `modelo`='$modelo'";
    mysqli_query($db, $query);
  }

  if($marca != ""){
    $query = "UPDATE vehiculo_aluguer SET marca='$marca' WHERE `modelo`='$modelo'";
    mysqli_query($db, $query);
  }

  if($prezo != ""){
    $query = "UPDATE vehiculo_aluguer SET prezo='$prezo' WHERE `modelo`='$modelo'";
    mysqli_query($db, $query);
  }

  if($foto != ""){
    $query = "UPDATE vehiculo_aluguer SET foto='$foto_SQL' WHERE `modelo`='$modelo'";
    mysqli_query($db, $query);
  }

  //Se non se atopan erros no formulario mandámolo á base de datos novo_rexistro
echo "Cambios completados, serás redirixido ao menú de admins en 3 segundos...";
mysqli_close($db);
header("refresh:3; url=logged_admin.php");
}

?> 
