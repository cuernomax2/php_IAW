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

//Rexistro dun novo vehículo
  //Mecanismo de validación do formulario de venda. Asegurámonos de que todos os datos están enchidos e dentro dos límites
if (strlen($modelo) < 1 || strlen($modelo) > 80){ 
  $erros[$contador] = "O modelo é inexistente ou demasiado longo (80 caracteres máximo)"; 
  $contador++;
}
  
if (strlen($cantidade) < 1){ 
  $erros[$contador] = "A cantidade debe ser mínimo 1."; 
  $contador++;
}
  
if (strlen($descricion) < 1 || strlen($descricion) > 120){ 
  $erros[$contador] = "A descrición é inexistente ou demasiado longa (120 caracteres máximo)"; 
  $contador++;
} 
  
if (strlen($marca) < 1 || strlen($marca) > 24){ 
  $erros[$contador] = "A marca é inexistente ou demasiado longa (24 caracteres máximo)"; 
  $contador++;
}
  
if (strlen($prezo) < 1){ 
  $erros[$contador] = "O prezo debe ser mínimo 1€."; 
  $contador++;
}
  
if (strlen($foto) < 1 || strlen($foto) > 1000){ 
  $erros[$contador] = "A foto é inexistente ou demasiado longa (1000 caracteres máximo)"; 
  $contador++;
}
  
  //Primeiro debemos comprobar a base de datos para saber 
  //se existe ou non un coche co modelo repetido (tabla vehiculo_venda)
$modelo_venda_query = "SELECT modelo FROM `vehiculo_venda` WHERE modelo='$modelo'";
$resultado = mysqli_query($db, $modelo_venda_query);
  //Gárdase o resultado da query en $resultado e compróbase
  //o número de filas. Se este é maior que 0 salta erro (o modelo xa existe na táboa vehiculo_venda)
if (($fila = mysqli_num_rows($resultado)) > 0){
  $erros[$contador] = "Erro: o modelo deste vehículo xa está rexistrado na base de datos";
  $contador++;
}

if($contador != 0){//Creamos un if/else que comprobe se a variable $contador está a 0 ou non
//En caso de que contador != 0 significa que houbo erros no rexistro e cun foreach procedemos
//a mostralos todos por pantalla
  foreach ($erros as $valor){
    echo $valor."";
    echo "<br>";
  }
    
  ?>
  <p><a href="insertar_nova_venda.php">Volver ao formulario de inserción de nova venda</a></p>
  <p><a href="logged_admin.php">Volver ao menú de admins</a></p>
  <?php
}

else{
  //Se non se atopan erros no formulario mandámolo á táboa de vehiculo_venda
  echo "Inserción completada, serás redirixido ao menú de admins en 3 segundos...";
  $query = "INSERT INTO vehiculo_venda (modelo, cantidade, descricion, marca, prezo, foto) VALUES ('$modelo', '$cantidade', '$descricion', '$marca', '$prezo', '$foto_SQL')";
  mysqli_query($db, $query);
  header("refresh:3; url=logged_admin.php");
}

mysqli_close($db);

?>  
