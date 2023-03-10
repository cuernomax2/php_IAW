<?php
// iniciamos as variables do programa
$usuario = $_REQUEST['usuario'];
$contrasinal = $_REQUEST['contrasinal'];
$nome = $_REQUEST['nome'];
$direccion = $_REQUEST['direccion'];
$telefono = $_REQUEST['telefono'];
$nifdni = $_REQUEST['nifdni'];
$email = $_REQUEST['email'];
$erros = array();//Array que recollerá todos os erros no rexistro
$contador = 0;//Variable contador que servirá tamén para comprobar se facer a inserción ou non

//Conectarse á base de datos
$db = mysqli_connect("localhost", "root", "", "frota");

//Rexistro dun novo usuario
  //Mecanismo de validación do formulario de rexistro. Asegurámonos de que todos os datos están enchidos
if (strlen($usuario) < 1 || strlen($usuario) > 24){ 
  $erros[$contador] = "O usuario é inexistente ou demasiado longo (24 caracteres máximo)"; 
  $contador++;
}
  
if (strlen($contrasinal) < 1 || strlen($contrasinal) > 8){ 
  $erros[$contador] = "A contrasinal é inexistente ou demasiado longa (8 caracteres máximo)"; 
  $contador++;
}
  
if (strlen($nome) < 1 || strlen($nome) > 60){ 
  $erros[$contador] = "O nome é inexistente ou demasiado longo (24 caracteres máximo)"; 
  $contador++;
} 
  
if (strlen($direccion) < 1 || strlen($direccion) > 60){ 
  $erros[$contador] = "A direccion é inexistente ou demasiado longa (90 caracteres máximo)"; 
  $contador++;
}
  
if (strlen($telefono) < 1 || strlen($telefono) > 10){ 
  $erros[$contador] = "O teléfono é inexistente ou demasiado longo (10 caracteres máximo)"; 
  $contador++;
}
  
if (strlen($nifdni) < 1 || strlen($nifdni) > 9){ 
  $erros[$contador] = "O DNI é inexistente ou demasiado longo (9 caracteres máximo)"; 
  $contador++;
}
  
if (strlen($email) < 1 || strlen($email) > 30){ 
  $erros[$contador] = "O e-mail é inexistente ou demasiado longo (30 caracteres máximo)"; 
  $contador++;
}

  //Primeiro debemos comprobar a base de datos para saber 
  //se existe ou non un usuario repetido (tablas novo_rexistro e usuarios)
$user_check_novo_rexistro_query = "SELECT usuario FROM `novo_rexistro` WHERE usuario='$usuario'";
$resultado_1 = mysqli_query($db, $user_check_novo_rexistro_query);
$filas_1 = mysqli_num_rows($resultado_1);
  //Gárdase o resultado da query en $resultado_1 e compróbase
  //o número de filas. Se este é maior que 0 salta erro (o usuario xa existe na DB novo_rexistro)
if (($filas_1) > 0){

  $erros[$contador] = "Erro: o usuario xa está esperando validación";
  $contador++;
}

//Facemos o mesmo proceso para comprobar se o usuario que se quere rexistrar xa existe 
//na táboa de usuarios validados
$user_check_usuarios_query = "SELECT usuario FROM `usuario` WHERE usuario='$usuario'";
$resultado_2 = mysqli_query($db, $user_check_usuarios_query);
$filas_2 = mysqli_num_rows($resultado_2);
  //Gárdase o resultado da query en $resultado_2 e compróbase
  //o número de filas. Se este é maior que 0 salta erro (o usuario xa existe na DB usuario)
if (($filas_2) > 0){

  $erros[$contador] = "Erro: o usuario xa existe e está validado";
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
  <p><a href="register.html">Volver ao formulario de rexistro</a></p>
  <p><a href="index.php">Volver ao inicio</a></p>
  <?php
}

else{
  //Se non se atopan erros no formulario mandámolo á base de datos novo_rexistro
  echo "Rexistro completado, serás redirixido ao index en 3 segundos...";
  $query = "INSERT INTO novo_rexistro (usuario, contrasinal, nome, direccion, telefono, nifdni, email) VALUES ('$usuario', '$contrasinal', '$nome', '$direccion', '$telefono', '$nifdni', '$email')";
  mysqli_query($db, $query);
  header("refresh:3; url=index.php");
}

mysqli_close($db);

?>
